<?php

namespace Tests;

use Laravel\Dusk\Browser as BaseBrowser;

class Browser extends BaseBrowser
{
    public function withinModal(callable $callback): self
    {
        return $this->within('@modal-content', $callback);
    }

    public function waitUntilMissingModal(): self
    {
        return $this->waitUntilMissingText('@modal-wrapper');
    }

    public function waitForModal(): self
    {
        return $this->waitFor('@modal-content');
    }
}
