<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\TodoModel;

class Todos extends ResourceController
{
    use ResponseTrait;
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new TodoModel();

        $data = $model->findAll();

        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new TodoModel();
        $data = $model->find($id);

        if (!$data) return $this->failNotFound('No data found!');

        return $this->respond($data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        helper(['form']);
        $rules = [
            'job' => 'required',
            'isCompleted' => 'required'
        ];

        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $data = [
            'job' => $this->request->getVar('job'),
            'isCompleted' => $this->request->getVar('isCompleted')
        ];

        $model = new TodoModel();
        $model->insert($data);
        $result = $model->find($model->insertID);

        return $this->respondCreated($result);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        helper(['form']);
        $rules = [
            'job' => 'required',
            'isCompleted' => 'required'
        ];

        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $data = [
            'job' => $this->request->getVar('job'),
            'isCompleted' => $this->request->getVar('isCompleted')
        ];

        $model = new TodoModel();
        if (!$model->find($id)) return $this->failNotFound();

        $model->update($id, $data);
        $result = $model->find($id);

        return $this->respondUpdated($result);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new TodoModel();
        if (!$model->find($id)) return $this->failNotFound();

        $model->delete($id);
        return $this->respondDeleted(['message' => 'Deleted succesfully!']);
    }
}
