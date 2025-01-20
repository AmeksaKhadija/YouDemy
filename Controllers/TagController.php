<?php
include_once dirname(__DIR__) . '/Models/TagModel.php';

class TagController
{
    private $conn;
    private $tagModel;

    public function __construct()
    {
        $conn = (new Connection())->connect();
        $this->tagModel = new TagModel($conn);
    }

    public function deleteTag($tagId)
    {
        $this->tagModel->deleteTag($tagId);
    }

    public function addTag($name, $description)
    {
        $this->tagModel->addTag($name,$description);
    }

    public function editTag($id,$name, $description)
    {
        $this->tagModel->editTag($id,$name, $description);
    }

    public function getAllTags()
    {
       $tags = $this->tagModel->getAllTags();
       return $tags;
    }

    public function getTagById($id)
    {
        return $this->tagModel->getTagById($id);
    }

    public function getTotalTags()
    {
        $tags = $this->tagModel->getTotalTags();
        return $tags;
    }
}

$tagController = new TagController();
