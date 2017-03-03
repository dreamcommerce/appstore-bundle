<?php

namespace DreamCommerce\ShopAppstoreBundle\Command;

use DreamCommerce\ShopAppstoreBundle\Handler\Application;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class WebhooksCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('dream_commerce_shop_appstore:webhooks')
            ->addArgument('app', InputArgument::OPTIONAL, 'Show webhooks for a particular app')
            ->addOption('global', 'g', InputOption::VALUE_NONE, 'Show global webhooks')
            ->setDescription('Dumps configured webhooks');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if($input->getOption('global')){
            $this->displayGlobalWebhooks($output);
            return;
        }

        $apps = $this->getContainer()->getParameter('dream_commerce_shop_appstore.apps');
        $registry = $this->getContainer()->get('dream_commerce_shop_appstore.apps');

        $app = $input->getArgument('app');
        if(!$app){
            foreach(array_keys($apps) as $app) {
                $obj = $registry->get($app);
                $this->displayAppWebhooks($obj, $output);
            }
        }else{
            $obj = $registry->get($app);
            if(!$obj){
                throw new \Exception(sprintf('App "%s" not found', $app));
            }
            $this->displayAppWebhooks($obj, $output);
        }

    }

    protected function renderWebhooks($webhooks, OutputInterface $output, $appId = null)
    {
        $table = new Table($output);

        $result = [];

        $routeName = sprintf('dream_commerce_shop_appstore.%s', $appId ? 'webhook.app' : 'webhooks');

        foreach($webhooks as $k=>$v){
            $events = implode(PHP_EOL, $v['events']);

            $routeParams = [
                'webhookId' => $k
            ];

            if($appId){
                $routeParams['appId'] = $appId;
            }

            $result[] = [
                $k,
                $this->getContainer()->get('router')->generate($routeName, $routeParams),
                $v['secret'],
                $events
            ];
        }

        $table
            ->setHeaders(array('Webhook name', 'URL', 'secret', 'events'))
            ->setRows($result);
        $table->render();

        $output->writeln('');
    }

    protected function displayGlobalWebhooks(OutputInterface $output){

        $output->writeln('<info>Globally registered webhooks</info>');
        $globalWebhooks = $this->getContainer()->getParameter('dream_commerce_shop_appstore.webhooks');

        $this->renderWebhooks($globalWebhooks, $output);

    }

    protected function displayAppWebhooks(Application $app, OutputInterface $output)
    {
        $output->writeln(
            sprintf('<info>Webhooks for application:</info> %s', $app->getApp())
        );

        $webhooks = $app->getWebhook();

        $this->renderWebhooks($webhooks, $output, $app->getApp());

    }
}
