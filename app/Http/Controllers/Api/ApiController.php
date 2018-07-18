<?php

namespace App\Http\Controllers\Api;

use App\Http\Middleware\ResourceMap;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    protected $statusCode = 200;
    protected $definition;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        //we return $this because we sometimes respond stuff like this:
        //$this->setStatusCode(202)->respond('message');
        return $this;
    }

    public function respond($data)
    {
        return Response::json($data, $this->getStatusCode());
    }

    public function respondWithError(\Throwable $throwable)
    {
        $this->setStatusCode($throwable->getCode());

        if ($this->statusCode > 700 ||
            $this->statusCode == 0 ||
            $this->statusCode == 42 ||
            $this->statusCode == 22 ||
            $this->statusCode == -1) {
            //likely an SQL error (for instance: foreign key dependency, not respecting default value...), let's tell them this is not authorized
            $this->setStatusCode(401);
        }

        if (env('APP_DEBUG')) {
            return $this->respond([
                'error' => [
                    'status_code' => $this->getStatusCode(),
                    'message' => $throwable->getMessage(),
                    'trace' => $throwable->getTraceAsString(),
                ],
            ]);
        }

        //if not debug, we are likely in a prod environment or something -> don't be verbose
        abort($this->getStatusCode(), 'Error ' . $this->getStatusCode());

    }

    public function setDefinition($resource)
    {
        $mapping = ResourceMap::getMapping();

        $key = array_search($resource, array_column($mapping, 'resource'));

        if ($key !== false) {
            //instantiate the classes so they are ready to be called
            $mapping[$key]['controller'] = app($mapping[$key]['controller']);
            $mapping[$key]['model'] = app($mapping[$key]['model']);

            $this->definition = $mapping[$key];
        } else {
            throw new Exception("Cannot find resource: " . $resource, 404);
        }
    }

    public function getCollection($resource, Request $request)
    {
        try {
            $this->setDefinition($resource);
            $response = [];

            if (isset($request->per_page)) {
                $items = $this->definition['model']::paginate($request->per_page);
            } else {
                $items = $this->definition['model']::all();
            }
            $response['data'] = $items;

            return $this->respond($response);
        } catch (\Throwable $e) {
            return $this->respondWithError($e);
        }
    }

    public function getItem($resource, $id, Request $request)
    {
        try {
            if (!is_numeric($id)) {
                throw new Exception('Please provide a valid id.', 404);
            }

            $this->setDefinition($resource);

            //non-smart resource
            $item = $this->definition['model']::find($id);

            return $this->respond([
                'data' => $item->toArray(),
            ]);
        } catch (\Throwable $e) {
            return $this->respondWithError($e);
        }
    }

    public function deleteItem($resource, $id)
    {
        try {
            $this->setDefinition($resource);
            $message = $this->definition['model']->destroy($id);

            return $this->respondWithSuccessMessage(201, $message);

        } catch (\Throwable $e) {
            return $this->respondWithError($e);
        }
    }

    public function createItem(Request $request, $resource)
    {
        try {
            $this->setDefinition($resource);
            $message = $this->definition['model']->create($request);

            return $this->respondWithSuccessMessage(201, $message);
        } catch (\Throwable $e) {
            return $this->respondWithError($e);
        }
    }

    public function updateItem(Request $request, $resource, $id)
    {
        try {
            $this->setDefinition($resource);
            $message = $this->definition['transformer']->where('id', $id)->update($request);

            return $this->respondWithSuccessMessage(202, $message);
        } catch (\Throwable $e) {
            return $this->respondWithError($e);
        }
    }

    public function respondWithSuccessMessage($statusCode, $message)
    {
        return $this->setStatusCode($statusCode)->respond([
            'displayAlert' => 'success',
            'message' => $message,
        ]);
    }
}
