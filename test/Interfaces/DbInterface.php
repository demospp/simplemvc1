<?php

namespace Interfaces;

interface DbInterface
{
    public function getConnect();
    public function query($query);
    public function escape($val):string ;
    public function close();
    public function getInsertId();
}