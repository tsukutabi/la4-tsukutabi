<?php

use Symfony\Component\Console\Input\InputOption;

/**
 * Simple deploy Artisan command.
 *
 * You can change command by config file setting.
 */
class BatchCommand extends BaseCommand
{
    /**
     * The dummy console command name.
     * This will be replaced by config setting.
     *
     * @var string
     */
    protected $name = 'batch';

    /**
     * The dummy console command description.
     * This will be replaced by language file setting.
     *
     * @var string
     */
    protected $description = 'バッチ処理実行ツール';

    /**
     * Execute the console command.
     *
     * Return value will be execute code of this command.
     * So don't return ture/false. It must be integer.
     *
     * @return integer Return Code. 0: Terminated successfully.
     */
    public function fire()
    {
        $args = array_merge( $this->option(), $this->argument() );

        if( $args['sweep-confirm'] )
        {
            $affected = User::whereActive( '0' )
                ->where( DB::raw( 'created_at + INTERVAL 24 HOUR' ), '<',
                    DB::raw( 'now()' ) )
                ->forceDelete();

            $this->line( 'ユーザーレコードを<green>'.$affected.'件</green>削除しました。' );
        }


        if( $args['purge-cache'] )
        {
            Cache::flush();

            $this->line( '全キャッシュをパージしました。' );
        }

        return 0;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [ ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            [
                'purge-cache',
                'p',
                InputOption::VALUE_NONE,
                '全キャッシュを削除する。',
                null
            ],
            [
                'sweep-confirm',
                's',
                InputOption::VALUE_NONE,
                '期限切れ登録確認キーレコードを削除する。',
                null
            ],
        ];
    }

}