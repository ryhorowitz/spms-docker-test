<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * LoremIpsum Controller
 *
 */
class LoremIpsumController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->LoremIpsum->find();
        $loremIpsum = $this->paginate($query);

        $this->set(compact('loremIpsum'));
    }

    /**
     * View method
     *
     * @param string|null $id Lorem Ipsum id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $loremIpsum = $this->LoremIpsum->get($id, contain: []);
        $this->set(compact('loremIpsum'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $loremIpsum = $this->LoremIpsum->newEmptyEntity();
        if ($this->request->is('post')) {
            $loremIpsum = $this->LoremIpsum->patchEntity($loremIpsum, $this->request->getData());
            if ($this->LoremIpsum->save($loremIpsum)) {
                $this->Flash->success(__('The lorem ipsum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lorem ipsum could not be saved. Please, try again.'));
        }
        $this->set(compact('loremIpsum'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lorem Ipsum id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $loremIpsum = $this->LoremIpsum->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $loremIpsum = $this->LoremIpsum->patchEntity($loremIpsum, $this->request->getData());
            if ($this->LoremIpsum->save($loremIpsum)) {
                $this->Flash->success(__('The lorem ipsum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lorem ipsum could not be saved. Please, try again.'));
        }
        $this->set(compact('loremIpsum'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lorem Ipsum id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $loremIpsum = $this->LoremIpsum->get($id);
        if ($this->LoremIpsum->delete($loremIpsum)) {
            $this->Flash->success(__('The lorem ipsum has been deleted.'));
        } else {
            $this->Flash->error(__('The lorem ipsum could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
