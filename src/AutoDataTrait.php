<?php

namespace GustavoSantarosa\ValidateTrait;

trait AutoDataTrait
{
    /**
     * Initialize the Set Schema trait for an instance.
     *
     * @return void
     */
    public function initializeAutoDataTrait()
    {
        $this->setSchema();
    }

    public function setSchema()
    {
        if (
            isset($this->initializedAutoDataTrait)
            && in_array(request()->route()->getActionMethod(), $this->initializedAutoDataTrait)
        ) {
            request()->data = $this->validate();
        }
    }
}
