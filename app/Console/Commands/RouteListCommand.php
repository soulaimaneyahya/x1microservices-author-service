<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RouteListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all registered routes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $router = app()->router;

        $routes = $router->getRoutes();

        $this->table(
            ['Method', 'URI', 'Name', 'Action', 'Middleware'],
            array_map(function ($route) {
                $methods = is_array($route['method']) ? $route['method'] : [$route['method']];

                return [
                    'Method' => implode('|', $methods),
                    'URI' => $route['uri'],
                    'Name' => $route['action']['as'] ?? '',
                    'Action' => $route['action']['uses'] ?? '',
                    'Middleware' => implode(',', (array)($route['action']['middleware'] ?? [])),
                ];
            }, $routes)
        );

        return 0;
    }
}
