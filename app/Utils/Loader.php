<?php

namespace LaraWord\Utils;

/**
 * Class Loader
 *
 * @package LaraWord\Utils
 * @author  Roman Shipelov <theship87@gmail.com>
 */
class Loader {

    protected $actions;

    protected $filters;

    /**
     * Loader constructor.
     */
    public function __construct() {

        $this->actions = [];
        $this->filters = [];
    }

    public function addAction( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {

        $this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
    }

    public function addFilter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {

        $this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
    }

    private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

        $hooks[] = array(
            'hook'          => $hook,
            'component'     => $component,
            'callback'      => $callback,
            'priority'      => $priority,
            'accepted_args' => $accepted_args
        );

        return $hooks;
    }

    public function run() {

        foreach ( $this->filters as $hook ) {
            add_filter( $hook['hook'], array(
                $hook['component'],
                $hook['callback']
            ), $hook['priority'], $hook['accepted_args'] );
        }

        foreach ( $this->actions as $hook ) {
            add_action( $hook['hook'], array(
                $hook['component'],
                $hook['callback']
            ), $hook['priority'], $hook['accepted_args'] );
        }
    }

}

