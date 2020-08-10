<?php


class VisitService
{
    private Repository $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function savingVisit(array $data)
    {
        $this->repository->createOrUpdate($data);
    }
}