<?php

require 'RepositoryInterface.php';


class VisitService
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function savingVisit(array $data)
    {
        $this->repository->createOrUpdate($data);
    }
}