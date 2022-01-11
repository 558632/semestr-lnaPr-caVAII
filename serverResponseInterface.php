<?php

interface serverResponseInterface{
    public function __toString(): string;
    public function addRow($string) : bool;
}