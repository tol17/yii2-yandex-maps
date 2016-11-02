<?php
namespace tol17\yandexmaps\Interfaces;

/**
 * interface EventAggregate
 */
interface EventAggregate
{
    /**
     * @return array
     */
    public function getEvents();
}