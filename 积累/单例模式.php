<?php
/*
 * ����ģʽ�ֳ�Ϊְ��ģʽ���������ڳ����д���һ����һ���ܵķ��ʵ㣬ͨ�׵�˵����ʵ���������Ķ�����Ψһ�ġ�
���еĵ���ģʽ����ӵ���������ֹ���Ԫ�أ�
1. ���Ǳ���ӵ��һ�����캯�������ұ��뱻���Ϊprivate
2. ����ӵ��һ���������ʵ���ľ�̬��Ա����
3. ����ӵ��һ���������ʵ���Ĺ����ľ�̬����
�����಻������������ֱ��ʵ������ֻ�ܱ�������ʵ�����������ᴴ��ʵ�����������ǻ��������ڲ��洢��ʵ������һ�����á�

 */
class Single{
    private $name;
    private function __construct($name='') {
        $this->name = $name;
    }
    static private $instance;
    static public function getInstance() {
        if(!self::$instance){
            self::$instance = new self::$instance;
        };
        return self::$instance;
    }
    ////��ֹ��¡����
    private function __clone(){
        
    }
    
    public function getname(){
        return $this->name;
    }
    
    public function setname($name='') {
        $this->name = $name;
    }
}
$a1 = new Single();
$a2 = new Single();
$a1->setname('chenghuan');
$a2->setname('lidan');
echo $a1->getname();
echo $a2->getname();