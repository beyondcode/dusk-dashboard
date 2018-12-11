<?php

namespace BeyondCode\DuskDashboard\Dusk\Concerns;

trait InteractsWithJavascript
{
    /** {@inheritdoc} */
    public function script($scripts)
    {
        $result = parent::script($scripts);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return $result;
    }
}
