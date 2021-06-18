<?php

namespace ContainerIenyd63;
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'persistence'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'Persistence'.\DIRECTORY_SEPARATOR.'ObjectManager.php';
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'orm'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'ORM'.\DIRECTORY_SEPARATOR.'EntityManagerInterface.php';
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'orm'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'ORM'.\DIRECTORY_SEPARATOR.'EntityManager.php';

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager|null wrapped object, if the proxy is initialized
     */
    private $valueHolder85e17 = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializer15899 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties96039 = [
        
    ];

    public function getConnection()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'getConnection', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->getConnection();
    }

    public function getMetadataFactory()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'getMetadataFactory', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->getMetadataFactory();
    }

    public function getExpressionBuilder()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'getExpressionBuilder', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->getExpressionBuilder();
    }

    public function beginTransaction()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'beginTransaction', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->beginTransaction();
    }

    public function getCache()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'getCache', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->getCache();
    }

    public function transactional($func)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'transactional', array('func' => $func), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->transactional($func);
    }

    public function commit()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'commit', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->commit();
    }

    public function rollback()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'rollback', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->rollback();
    }

    public function getClassMetadata($className)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'getClassMetadata', array('className' => $className), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->getClassMetadata($className);
    }

    public function createQuery($dql = '')
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'createQuery', array('dql' => $dql), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->createQuery($dql);
    }

    public function createNamedQuery($name)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'createNamedQuery', array('name' => $name), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->createNamedQuery($name);
    }

    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->createNativeQuery($sql, $rsm);
    }

    public function createNamedNativeQuery($name)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->createNamedNativeQuery($name);
    }

    public function createQueryBuilder()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'createQueryBuilder', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->createQueryBuilder();
    }

    public function flush($entity = null)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'flush', array('entity' => $entity), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->flush($entity);
    }

    public function find($className, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'find', array('className' => $className, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->find($className, $id, $lockMode, $lockVersion);
    }

    public function getReference($entityName, $id)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->getReference($entityName, $id);
    }

    public function getPartialReference($entityName, $identifier)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->getPartialReference($entityName, $identifier);
    }

    public function clear($entityName = null)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'clear', array('entityName' => $entityName), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->clear($entityName);
    }

    public function close()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'close', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->close();
    }

    public function persist($entity)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'persist', array('entity' => $entity), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->persist($entity);
    }

    public function remove($entity)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'remove', array('entity' => $entity), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->remove($entity);
    }

    public function refresh($entity)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'refresh', array('entity' => $entity), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->refresh($entity);
    }

    public function detach($entity)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'detach', array('entity' => $entity), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->detach($entity);
    }

    public function merge($entity)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'merge', array('entity' => $entity), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->merge($entity);
    }

    public function copy($entity, $deep = false)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->copy($entity, $deep);
    }

    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->lock($entity, $lockMode, $lockVersion);
    }

    public function getRepository($entityName)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'getRepository', array('entityName' => $entityName), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->getRepository($entityName);
    }

    public function contains($entity)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'contains', array('entity' => $entity), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->contains($entity);
    }

    public function getEventManager()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'getEventManager', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->getEventManager();
    }

    public function getConfiguration()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'getConfiguration', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->getConfiguration();
    }

    public function isOpen()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'isOpen', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->isOpen();
    }

    public function getUnitOfWork()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'getUnitOfWork', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->getUnitOfWork();
    }

    public function getHydrator($hydrationMode)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->getHydrator($hydrationMode);
    }

    public function newHydrator($hydrationMode)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->newHydrator($hydrationMode);
    }

    public function getProxyFactory()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'getProxyFactory', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->getProxyFactory();
    }

    public function initializeObject($obj)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'initializeObject', array('obj' => $obj), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->initializeObject($obj);
    }

    public function getFilters()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'getFilters', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->getFilters();
    }

    public function isFiltersStateClean()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'isFiltersStateClean', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->isFiltersStateClean();
    }

    public function hasFilters()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'hasFilters', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return $this->valueHolder85e17->hasFilters();
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();

        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $instance, 'Doctrine\\ORM\\EntityManager')->__invoke($instance);

        $instance->initializer15899 = $initializer;

        return $instance;
    }

    protected function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config, \Doctrine\Common\EventManager $eventManager)
    {
        static $reflection;

        if (! $this->valueHolder85e17) {
            $reflection = $reflection ?? new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHolder85e17 = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);

        }

        $this->valueHolder85e17->__construct($conn, $config, $eventManager);
    }

    public function & __get($name)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, '__get', ['name' => $name], $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        if (isset(self::$publicProperties96039[$name])) {
            return $this->valueHolder85e17->$name;
        }

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder85e17;

            $backtrace = debug_backtrace(false, 1);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    $realInstanceReflection->getName(),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
        }

        $targetObject = $this->valueHolder85e17;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, '__set', array('name' => $name, 'value' => $value), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder85e17;

            $targetObject->$name = $value;

            return $targetObject->$name;
        }

        $targetObject = $this->valueHolder85e17;
        $accessor = function & () use ($targetObject, $name, $value) {
            $targetObject->$name = $value;

            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, '__isset', array('name' => $name), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder85e17;

            return isset($targetObject->$name);
        }

        $targetObject = $this->valueHolder85e17;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, '__unset', array('name' => $name), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder85e17;

            unset($targetObject->$name);

            return;
        }

        $targetObject = $this->valueHolder85e17;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);

            return;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $accessor();
    }

    public function __clone()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, '__clone', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        $this->valueHolder85e17 = clone $this->valueHolder85e17;
    }

    public function __sleep()
    {
        $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, '__sleep', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;

        return array('valueHolder85e17');
    }

    public function __wakeup()
    {
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
    }

    public function setProxyInitializer(\Closure $initializer = null) : void
    {
        $this->initializer15899 = $initializer;
    }

    public function getProxyInitializer() : ?\Closure
    {
        return $this->initializer15899;
    }

    public function initializeProxy() : bool
    {
        return $this->initializer15899 && ($this->initializer15899->__invoke($valueHolder85e17, $this, 'initializeProxy', array(), $this->initializer15899) || 1) && $this->valueHolder85e17 = $valueHolder85e17;
    }

    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolder85e17;
    }

    public function getWrappedValueHolderValue()
    {
        return $this->valueHolder85e17;
    }
}

if (!\class_exists('EntityManager_9a5be93', false)) {
    \class_alias(__NAMESPACE__.'\\EntityManager_9a5be93', 'EntityManager_9a5be93', false);
}
