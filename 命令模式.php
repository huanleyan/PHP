<?php
/*
命令模式是一种行为型模式，它将一个请求封装为一个对象，从而使用你可用不同的请求对客户进行参数化；对请求排队或记录请求日志，以及支持可撤消的操作。
命令模式把发出命令的责任和执行命令的责任分割开，委派给不同的对象。
请求的一方发出请求要求执行一个操作；接收的一方收到请求，并执行操作。命令模式允许请求的一方和接收的一方独立开来，使得请求的一方不必知道接收请求的一方的接口，
更不必知道请求是怎么被接收，以及操作是否被执行、何时被执行，以及是怎么被执行的。

主要角色
命令（Command）角色：
    声明了一个给所有具体命令类的抽象接口。这是一个抽象角色。
具体命令（ConcreteCommand）角色：
    定义一个接受者和行为之间的弱耦合；实现Execute()方法，负责调用接收考的相应操作。Execute()方法通常叫做执行方法。
客户（Client）角色：
    创建了一个具体命令(ConcreteCommand)对象并确定其接收者。
请求者（Invoker）角色：
    负责调用命令对象执行请求，相关的方法叫做行动方法。
接收者（Receiver）角色：
     负责具体实施和执行一个请求。任何一个类都可以成为接收者，实施和执行请求的方法叫做行动方法。

优点
    命令模式把请求一个操作的对象与知道怎么执行一个操作的对象分离开。
    命令类与其他任何别的类一样，可以修改和推广。
    可以把命令对象聚合在一起，合成为合成命令。
    可以很容易的加入新的命令类。
缺点
    可能会导致某些系统有过多的具体命令类。


*/


interface Command { // 命令角色
    public function execute(); // 执行方法
}

class ConcreteCommand implements Command { // 具体命令方法
    private $_receiver;
    public function __construct(Receiver $receiver) {
        $this->_receiver = $receiver;
    }
    public function execute() {
        $this->_receiver->action();
    }
}

class Receiver { // 接收者角色
    private $_name;
    public function __construct($name) {
        $this->_name = $name;
    }
    public function action() {
        echo $this->_name;
    }
}

class Invoker { // 请求者角色
    private $_command;
    public function __construct(Command $command) {
        $this->_command = $command;
    }
    public function action() {
        $this->_command->execute();
    }
}

$receiver = new Receiver('hello world');
$command = new ConcreteCommand($receiver);
$invoker = new Invoker($command);
$invoker->action();