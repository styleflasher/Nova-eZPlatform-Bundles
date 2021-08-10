<?php

/*
 * NovaeZ2FABundle.
 *
 * @package   NovaeZ2FABundle
 *
 * @author    Yassine HANINI
 * @copyright 2021 AlmaviaCX
 * @license   https://github.com/Novactive/NovaeZ2FA/blob/main/LICENSE
 */

declare(strict_types=1);

namespace Novactive\Bundle\eZ2FABundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Novactive\Bundle\eZ2FABundle\DependencyInjection\NovaeZ2FAExtension;
use LogicException;

final class NovaeZ2FABundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
    }

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $extension = new NovaeZ2FAExtension();
            if (!$extension instanceof ExtensionInterface) {
                $fqdn = \get_class($extension);
                $message = 'Extension %s must implement %s.';
                throw new LogicException(sprintf($message, $fqdn, ExtensionInterface::class));
            }
            $this->extension = $extension;
        }

        return $this->extension;
    }
}