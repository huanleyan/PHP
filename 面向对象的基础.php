<?php
/*
 Abstract Class与Interface的异同
相同点
    两者都是抽象类，都不能实例化。
    interface 实现类及 abstract class 的子类都必须要实现已经声明的抽象方法。
不同点
    interface 需要实现，要用 implements ，而 abstract class 需要继承，要用 extends 。
    一个类可以实现多个 interface ，但一个类只能继承一个 abstract class 。
    interface 强调特定功能的实现，而 abstract class 强调所属关系。
    尽管 interface 实现类及 abstract class 的子类都必须要实现相应的抽象方法，但实现的形式不同。 interface 中的每一个方法都是抽象方法，都只是声明的 (declaration, 没有方法体 ) ，实现类必须要实现。
    　　   而 abstract class 的子类可以有选择地实现。这个选择有两点含义：
    　　　　a) abstract class 中并非所有的方法都是抽象的，只有那些冠有 abstract 的方法才是抽象的，子类必须实现。那些没有 abstract 的方法，在 abstract class 中必须定义方法体；
    　　　　b) abstract class 的子类在继承它时，对非抽象方法既可以直接继承，也可以覆盖；而对抽象方法，可以选择实现，也可以留给其子类来实现，但此类必须也声明为抽象类。既是抽象类，当然也不能实例化。
abstract class 是 interface 与 class 的中介。 abstract class 在 interface 及 class 中起到了承上启下的作用。一方面， abstract class 是抽象的，可以声明抽象方法，以规范子类必须实现的功能；另一方面，它又可以定义缺省的方法体，供子类直接使用或覆盖。另外，它还可以定义自己的实例变量，以供子类通过继承来使用。
    接口中的抽象方法前不用也不能加 abstract 关键字，默认隐式就是抽象方法，也不能加 final 关键字来防止抽象方法的继承。而抽象类中抽象方法前则必须加上 abstract 表示显示声明为抽象方法。
    接口中的抽象方法默认是 public 的，也只能是 public 的，不能用 private ， protected 修饰符修饰。而抽象类中的抽象方法则可以用 public ， protected 来修饰，但不能用 private 。
*/