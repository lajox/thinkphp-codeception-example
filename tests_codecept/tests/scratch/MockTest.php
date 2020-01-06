<?php

class MockTest extends \Codeception\Test\Unit
{
    /**
     * @var \ScratchTester
     */
    protected $tester;

    protected function _before()
    {
        // 目录 tests/_library/ 下的文件将会自动加载
        \Codeception\Util\Autoload::addNamespace('',  __DIR__.'/../_library');
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        # 更多详细文档： https://codeception.com/docs/reference/Mock

        # 注释：
        # 方法 makeEmpty 是不会触发构造函数__construct()， 所以经常用于接口的构造
        # 方法 make 是会触发构造函数__construct()， 所以经常用于类的构造实例。 如果不想触发类的构造方法，请改为 makeEmpty
        # 方法 makeEmptyExcept 是不会触发构造函数__construct()， 用法类似于makeEmpty， 区别是 可以指定排除某个方法. (天哪，竟然只能指定排除一个方法，不能指定多个， 太不智能了）

        \Codeception\Util\Autoload::load('\User'); // 加载类 User

        $userRepository = $this->makeEmpty(\UserRepository::class, ['find' => function ($id) { return new \User($id); }]);
        $user = $userRepository->find(2); // 指定 $id = 2
        $this->debugSection('userRepository', stripslashes(json_encode($userRepository)));
        $this->debugSection('UserName', $user->getName()); // 会输出： John

        $user = $this->makeEmptyExcept('\User', 'save', array('name' => 'davert')); // 排除掉 save 方法
        $this->debugSection('User', $user);

        $this->debugSection('==分割线==', '------------------------------------------');

        # 模拟创建某个接口下的类实例：
        $userRepository = $this->makeEmpty(\UserRepository::class, ['find' => new \User(1)]);
        $user = $userRepository->find(1);
        $this->debugSection('User', $user);
        $this->debugSection('UserAll', $userRepository->findAll());
        $user->getName();
        $userName = $user->getName();
        $this->assertEquals('Davert', $userName);
        $this->debugSection('UserName', $userName);
        $user->someMethod();

        # 模拟创建具体某个类实例：
        $user = $this->make(new \User(1), [
            'name' => 'davert',
            'add' => true, // 重写add方法， 直接返回值 true
            'save' => function () { return true; }, // 重写save方法， 函数返回值 true
            'sum' => function ($a, $b) { return $a + $b; }, // 重写sum方法和参数，用于求和
        ]);
        $user->save();
        $this->debugSection('save', $user->save());
        $this->debugSection('sum', $user->sum(1, 2)); // 计算 1 + 2的结果
        $userName = $user->getName();
        $this->assertEquals('davert', $userName);
        $this->debugSection('UserName', $userName);

        $this->_testStub();
        $this->_testMore();
    }

    protected function _testStub()
    {
        # 更多详细文档： http://codeception.com/docs/reference/Stub

        $user = \Codeception\Stub::makeEmpty('\Book', ['getName' => 'john']);
        $name = $user->getName(); // 'john'
        $this->assertEquals('john', $name);
        $this->debugSection('Book::getName', $name);

        $stub = \Codeception\Util\Stub::makeEmpty('\Book', [
            'myMethod' => \Codeception\Util\Stub::exactly(2, function () { return 'returnValue'; })
        ]);
        $stub->myMethod();
        $stub->myMethod();
    }

    protected function _testMore()
    {
        \Codeception\Util\Autoload::load('\UpdateBalance'); // 加载类 UpdateBalance

        $balanceRepository = $this->makeEmpty(\BalanceRepositoryInterface::class, ['fetchAmount' => function ($price, $number) {
            return $price * $number;
        }]);

        # part.1
        $amount = (new \UpdateBalance($balanceRepository))->fetchAmount(10, 3); // 计算出结果： 30
        $this->debugSection('UpdateBalance::fetchAmount', $amount);

        # part.2
        $updateBalance = $this->makeEmpty(\UpdateBalance::class, $params = [
            'fetchAmount' => function ($price, $number) use($balanceRepository) {
                return $balanceRepository->fetchAmount($price, $number);
            }
        ]);
        $this->debugSection('updateBalance', stripslashes(json_encode($updateBalance)));
        $amount = $updateBalance->fetchAmount(10, 3); // 计算出结果： 30
        $this->debugSection('UpdateBalance::fetchAmount', $amount);
        $updateBalance = $this->makeEmpty(new \UpdateBalance($balanceRepository), $params = [
            'fetchAmount' => function ($price, $number) use($balanceRepository) {
                return $balanceRepository->fetchAmount($price, $number);
            }
        ]);
        $this->debugSection('updateBalance', stripslashes(json_encode($updateBalance)));
        $amount = $updateBalance->fetchAmount(10, 3); // 计算出结果： 30
        $this->debugSection('UpdateBalance::fetchAmount', $amount);

        # part.3
        $updateBalance = $this->construct(\UpdateBalance::class, ['balanceRepository' => $balanceRepository], $params = []);
        $this->debugSection('updateBalance', stripslashes(json_encode($updateBalance)));
        $amount = $updateBalance->fetchAmount(10, 3); // 计算出结果： 30
        $this->debugSection('UpdateBalance::fetchAmount', $amount);
    }

    /**
     * debug
     */
    protected function debugSection($title, $message)
    {
        if (is_object($message)) {
            try {
                $message = var_export($message, true);
            } catch (\Exception $exception) {
                $message = print_r($message, true);
            }
        } else if(is_array($message)) {
            $message = stripslashes(json_encode($message));
        } else if(is_bool($message) || is_null($message)) {
            $message = json_encode($message);
        }
        \codecept_debug("[$title] $message");
    }
}