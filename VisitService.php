<?php

require 'Repository.php';

class VisitService
{
    private Repository $repository;
    private array $condition;

    public function __construct(array $server)
    {

        $this->repository = new Repository();
        $this->condition = [
            'ip' => $server['REMOTE_ADDR'],
            'user_agent' => $server['HTTP_USER_AGENT'],
            'view_date' => date("y.m.d"),
            'page_url' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
        ];
    }

    public function savingVisit()
    {
        if ($this->repository->exist($this->condition)) {
            $this->repository->updateCount($this->condition);
        } else {
            $this->repository->create($this->condition);
        }
    }
}