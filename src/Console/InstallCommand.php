<?php declare(strict_types=1);


namespace Iosum\AdminVueUI\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'admin-vue-ui:install';

    protected $description = 'Install all of the admin resources';

    public function handle(): void
    {
        $this->comment('Publishing Admin UI Assets...');

        $this->callSilent('vendor:publish', [
            '--tag' => 'admin-vue-ui-assets',
            '--provider' => 'Iosum\AdminVueUI\Providers\AdminVueUIServiceProvider',
            '--force' => true
        ]);

        $this->callSilent('vendor:publish', [
            '--tag' => 'admin-vue-ui-views',
            '--provider' => 'Iosum\AdminVueUI\Providers\AdminVueUIServiceProvider',
            '--force' => true
        ]);

        $this->info('Admin UI installed successfully.');
    }
}