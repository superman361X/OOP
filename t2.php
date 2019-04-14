<?php


interface IObserver
{
    public function update();
}

class ObserverA implements IObserver
{
    public function update()
    {
        echo 'do something A...';
        echo PHP_EOL;
    }
}


class ObserverB implements IObserver
{
    public function update()
    {
        echo 'do something B...';
        echo PHP_EOL;
    }
}

abstract class Observer
{
    private $observers = [];

    public function register(IObserver $observer)
    {
        $this->observers[] = $observer;
    }

    protected function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }

    public abstract function trigger();
}

class Event extends Observer
{
    public function trigger()
    {
        $this->notify();
    }
}

$obj = new Event();
$obj->register(new ObserverA());
$obj->register(new ObserverB());
$obj->trigger();
