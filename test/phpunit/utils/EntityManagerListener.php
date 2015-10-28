<?php
/**
 * @link https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils;



use OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\Paths;
use PHPUnit_Framework_TestListener;
use PHPUnit_Framework_Test;
use Exception;
use PHPUnit_Framework_AssertionFailedError;
use PHPUnit_Framework_TestSuite;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Doctrine\DBAL\DriverManager;


/**
 * Class RabbitMqTestListener
 *
 * @package OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils
 */
class  RabbitMqTestListener implements PHPUnit_Framework_TestListener
{

    /**
     *
     * @var string
     */
    const CONNECTION_CONFIG = 'connectionConfig';

    /**
     * Настройки листенера
     *
     * @var array
     */
    protected $options = [];

    /**
     * @inheritDoc
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @inheritDoc
     */
    public function addError(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
    }

    /**
     * @inheritDoc
     */
    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time)
    {
    }

    /**
     * @inheritDoc
     */
    public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
    }

    /**
     * @inheritDoc
     */
    public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
    }

    /**
     * @inheritDoc
     */
    public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
    }

    /**
     * @inheritDoc
     */
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite)
    {
    }

    /**
     * @inheritDoc
     */
    public function endTestSuite(PHPUnit_Framework_TestSuite $suite)
    {
    }

    /**
     * @inheritDoc
     *
     * @throws \InvalidArgumentException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\ORM\ORMException
     */
    public function startTest(PHPUnit_Framework_Test $test)
    {
        if ($test instanceof EntityManagerAwareInterface && !$test->hasEntityManager()) {
            $manager = $this->getEntityManager();
            $test->setEntityManager($manager);
        }
    }

    /**
     * @return EntityManager
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\ORM\ORMException
     * @throws \InvalidArgumentException
     */
    public function  getEntityManager()
    {
        $cache = new ArrayCache();
        $config = new Configuration();
        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);
        $config->setAutoGenerateProxyClasses(false);
        $config->setProxyDir(Paths::getPathToTestDoctrineProxies());
        $config->setProxyNamespace('Workflow\Proxies');

        $driverChain = new MappingDriverChain();

        $annotationProjectDriver = $config->newDefaultAnnotationDriver([Paths::getPathToDoctrineMetadata()], false);
        $driverChain->addDriver($annotationProjectDriver, 'OldTown\Workflow\Spi\Doctrine\Entity');





        $xmDescriptorDriver = new XmlDriver([Paths::getPathToDescriptorDoctrineMetadata()]);
        $driverChain->addDriver($xmDescriptorDriver, 'OldTown\Workflow\Loader');

        $config->setMetadataDriverImpl($driverChain);

        $conf = [];
        $options = $this->getOptions();
        if (array_key_exists(static::CONNECTION_CONFIG, $options)) {
            $conf = $options[static::CONNECTION_CONFIG];
        }

        $conn = DriverManager::getConnection($conf);

        $em = EntityManager::create($conn, $config);


        return $em;
    }


    /**
     * @inheritDoc
     */
    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
    }

}
