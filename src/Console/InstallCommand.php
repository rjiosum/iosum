<?php declare(strict_types=1);


namespace Iosum\AdminUI\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'admin-ui:install';

    protected $description = 'Install all of the admin resources';

    public function handle()
    {
        $this->comment('Publishing Admin UI Assets...');

        $this->callSilent('vendor:publish', [
            '--tag' => 'admin-assets',
            '--provider' => 'Iosum\AdminUI\Providers\AdminUIServiceProvider',
            '--force' => true
        ]);

        $this->info('Admin UI installed successfully.');
    }
}