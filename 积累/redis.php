<?php
//---------------string ���Ͳ���-----------------------

$redis = new Redis();
$redis->set('key','TK');
$redis->set('number', '1');
$redis->setex('key', 5, 'TK');   //������Ч��Ϊ5��ļ�ֵ
$redis->psetex('key', 5000, 'TK');  //������Ч��Ϊ5000����ļ�ֵ
$redis->setnx('key', 'XK');   //����ֵ���ڷ���false  �����ڷ���true
$redis->delete('key');   //ɾ����ֵ�����Դ�������[a,b,c]ɾ�������
$redis->getSet('key', 'XK');  //����key ��ֵ����ΪXK�������������ֵԭ����ֵTK
$ret = $redis->multi()  //����������,����֤�������ݵ�ԭ����
        ->set('key1', 'val1')
        ->get('key1')
        ->setnx('key', 'val2')
        ->get('key2')
        ->exec();

function f($redis, $chan, $msg){  //Ƶ������
    switch ($chan){
        case 'chan-1':
            echo $msg;
            break;
        case 'chan-2':
            echo $msg;
            break;
        case 'chan-3':
            echo $msg;
            break;
    }
}
$redis->subscribe(['chan-1', 'chan-2', 'chan-3'], 'f');    //Ƶ������
$redis->publish('chan-1', 'hello world');   //��chan-1�ܵ�����msg
$redis->exists('key');   //��֤���Ƿ���ڣ����ڷ���true
$redis->incr('number');   //��ֵ+1
$redis->incrBy('number', -10);   //��ֵ�Ӽ�10 
$redis->incrByFloat('number', +1.5);   //��ֵ�Ӽ�С��
$redis->decr('number');   //��ֵ��1
$redis->decrBy('number', 10);  //��ֵ��10
$mget = $redis->mget(['key','number']);    //������ȡһ����ֵ������һ������
$redis->mset(['key0'=>'value0', 'key1'=>'value1', 'key2'=>'value2']);   //�������ü�ֵ
$redis->msetnx(['key0'=>'value0', 'key1'=>'value1', 'key2'=>'value2']);  //�������ü�ֵ�����ƽ�setnx()������������
$redis->append('key', '-abc');  //ԭ��ֵTK����ֵ׷�ӵ���ֵ���棬��ֵΪTK-abc
$redis->getRange('key', 0, 5);   //��ֵ��ȡ��0λ�ÿ�ʼ��5λ�ý���
$redis->getRange('key', -6, -1);  //�ַ�����ȡ��-6����������λ�ã���ʼ��-1��������һλ�ã�����
$redis->setRange('key', '0', 'hijk');   //��ֵ���滻�ַ����� 0��ʾ��0λ�ÿ�ʼ���ж����ַ��滻����λ�ã����к���ռ������λ��
$redis->strlen('key');   //��ֵ����


//------------------list�������------------------------
$redis->delete('list-key');   //ɾ������ 
$redis->lPush('list-key', 'A');    //��������ͷ��/��࣬����������
$redis->rPush('list-key', 'B');    //��������β��/�Ҳ࣬����������
$redis->lPushx('list-key', 'C');   //��������ͷ��/��࣬�������ڷ���0�����ڼ�����ɹ������ص�ǰ������
$redis->rPushx('list-key', 'C');   //// ��������ͷ��/���,�������ڷ���0�����ڼ�����ɹ������ص�ǰ������
$redis->lPop('list-key');        //����LIST��������ࣩ��VALUE�� �����ȳ���ջ��
$redis->rPop('list-key');        //����LISTβ�����Ҳࣩ��VALUE�������ȳ������У�
$redis->lSize('list-key');   //����������������ȣ���������0��������������߲�Ϊ�գ��򷵻�false
$redis->lGet('list-key', -1);   //ͨ��������ȡ����Ԫ�� 0��ȡ���һ���� -1��ȡ���һ��
$redis->lSet('list-key', 0, 'X');    //0λ��Ԫ���滻ΪX
$redis->lrange('list-key', 0, 3);    ////�����ȡ ��0��ʼ 3λ�ý��� ������λ��Ϊ-1 ��ȡ��ʼλ��֮���ȫ��
$redis->ltrim('list-key', 0, 1);    //��ȡ�����0������ʼ��1��������
$redis->lrem('list-key');
$redis->lInsert('list-key', Redis::BEFORE, 'C', 'X'); // ��CԪ��ǰ�����X  , Redis::AfTER(��ʾ�������) �������������ʧ�� ����0 ��Ԫ�ز����ڷ���-1
$redis->rpoplpush('list-key', 'list-key2');  //  ��ԴLIST����󵯳�һ��Ԫ�� ���Ұ����Ԫ�ش�Ŀ��LIST�Ķ�������ࣩѹ��Ŀ��LIST


//-----------------------Set��������---------------------------
//set���򼯺� ����������ظ���Ԫ�� ����˿���ʵ�ֶ�� ���ϲ���
$redis->sMembers('key');    //��ȡ����key������Ԫ��
$redis->sAdd('key', 'TK');    //�������룬�������Ԫ����0λ�ã��������Ѿ�����TK���򷵻�false����������ӳɹ�����true
$redis->srem('key', 'TK');    //�Ƴ������е�TK
$redis->sMove('key', 'key1', 'TK');   //������key�е�Ԫ��TK�ƶ�������key1�������ɹ�����TRUE
$redis->sismember('key', 'TK');   //���value�Ƿ���SET�����еĳ�Ա
$redis->scard('key');     //����set�����ĳ�Ա��
$redis->sPop('key');   //������������е�һ��Ԫ�أ����Ƴ���Ԫ��
$redis->sRandMember('key'); //������������е�һ��Ԫ�أ����Ƴ���Ԫ��
$redis->sInter('key', 'key1');  //�����������ϵĽ�����û�н�������һ��������
$redis->sInterStore('store', 'key', 'key1');  //������key�ͼ���key1�Ľ�����������store���ɹ�����1
$redis->sUnion('key', 'key1');  //����key��key1�Ĳ���������ͬԪ�أ�ֻ����һ��
$redis->sUnionStore('store', 'key', 'key1');  //����key�ͼ���key1�Ĳ��������ڼ���store�У��ж����ͬԪ��ֻ����һ��
$redis->sDiff('key', 'key1', 'key2');  //�������������飬������Ԫ�ش�����key���ϣ����������ڼ���key1��key2




//-----------------------Zset��������---------------------------
$redis->zAdd('tkey', 1, 'A');//  ���뼯��tkey�У�AԪ�ع���һ������������ɹ�����1 ͬʱ����Ԫ�ز������ظ�, ���Ԫ���Ѿ����ڷ��� 0
$redis->zRange('tkey',0,-1); // ��ȡ����Ԫ�أ���0λ�� �� -1 λ��
$redis->zRange('tkey',0,-1, true);// ��ȡ����Ԫ�أ���0λ�� �� -1 λ��, ����һ���������� ������array([A] => 0.01,[B] => 0.02,[D] => 0.03) ����С������zAdd�����ڶ�������
$redis->zDelete('tkey', 'B'); // �Ƴ�����tkey��Ԫ��B  �ɹ�����1 ʧ�ܷ��� 0
$redis->zRevRange('tkey', 0, -1); // ��ȡ����Ԫ�أ���0λ�� �� -1 λ�ã����鰴��score������
$redis->zRevRange('tkey', 0, -1,true);// ��ȡ����Ԫ�أ���0λ�� �� -1 λ�ã����鰴��score������ ����score��������
$redis->zRangeByScore('tkey', 0, 0.2,array('withscores' => true));//��ȡ����tkey��score������[0,0.2]Ԫ�� ,score�ɵ͵�������,Ԫ�ؾ�����ͬ��score����ô�ᰴ���ֵ�˳������ , withscores ���Ʒ��ع�������
$redis->zRangeByScore('tkey', 0.1, 0.36, array('withscores' => TRUE, 'limit' => array(0, 1)));//����limit�� 0��1 ��ʾȡ�������������� ��0λ�ÿ�ʼ�����ɨ��1�� ���ع�������
$redis->zCount('tkey', 2, 10); // ��ȡtkey��score������[2, 10]Ԫ�صĸ���
$redis->zRemRangeByScore('tkey', 1, 3); // �Ƴ�tkey��score������[1, 3](���߽�)��Ԫ��
$redis->zRemRangeByRank('tkey', 0, 1);//Ĭ��Ԫ��score�ǵ����ģ��Ƴ�tkey��Ԫ�� ��0��ʼ��-1λ�ý���
$redis->zSize('tkey');  //���ش洢��key��Ӧ�����򼯺��е�Ԫ�صĸ���
$redis->zScore('tkey', 'A'); // ���ؼ���tkey��Ԫ��A��scoreֵ
$redis->zRank('tkey', 'A');// ���ؼ���tkey��Ԫ��A������ֵ   z������Ԫ�ذ���score�ӵ͵��߽������� ������͵�score index����Ϊ0
$redis->zIncrBy('tkey', 2.5, 'A'); // ������tkey��Ԫ��A��scoreֵ �� 2.5
$redis->zUnion('union', array('tkey', 'tkey1'));// ������tkey�ͼ���tkey1Ԫ�غϲ��ڼ���union , �����¼�����Ԫ�ز����ظ������¼��ϵ�Ԫ�ظ����� ���Ԫ��A��tkey��tkey1�����ڣ���ϲ����Ԫ��A��score���
$redis->zUnion('ko2', array('k1', 'k2'), array(5, 2));// ����k1�ͼ���k2������k02 ��array(5,1)��Ԫ�صĸ������Ӽ��϶�Ӧ��Ȼ�� 5 ��Ӧk1  k1ÿ��Ԫ��score��Ҫ����5 ��ͬ��1��Ӧk2��k2ÿ��Ԫ��score����1 Ȼ��Ԫ�ذ��յ�������Ĭ����ͬ��Ԫ��score(SUM)���
$redis->zUnion('ko2', array('k1', 'k2'), array(10, 2),'MAX');// �����Ӽ���������֮��Ԫ�ذ��յ���������ͬ��Ԫ�ص�scoreȡ���ֵ(MAX) Ҳ��������MIN ȡ��Сֵ
$redis->zInter('ko1', array('k1', 'k2'));// ����k1�ͼ���k2ȡ������k01 ���Ұ���scoreֵ�������� �������Ԫ����ͬ�����¼����е�Ԫ�ص�scoreֵ���
$redis->zInter('ko1', array('k1', 'k2'), array(5, 1));//����k1�ͼ���k2ȡ������k01 ��array(5,1)��Ԫ�صĸ������Ӽ��϶�Ӧ��Ȼ�� 5 ��Ӧk1k1ÿ��Ԫ��score��Ҫ����5 ��ͬ��1��Ӧk2��k2ÿ��Ԫ��score����1��Ȼ��Ԫ��score���յ�������Ĭ����ͬ��Ԫ��score(SUM)���
$redis->zInter('ko1', array('k1', 'k2'), array(5, 1),'MAX');// �����Ӽ���������֮��Ԫ��score���յ���������ͬ��Ԫ��scoreȡ���ֵ(MAX)   Ҳ��������MIN ȡ��Сֵ




//----------------------------Hash ��������----------------------------
//redis hash��һ��string���͵�field��value��ӳ���.������ӣ�ɾ����������O(1)��ƽ����.hash�ر��ʺ����ڴ洢����
$redis->hSet('h', 'name', 'TK');       //��h���У����name�ֶ�  valueΪTK
$redis->hSetNx('h','name', 'TK');    //// ��h���� ���name�ֶ� valueΪTK ����ֶ�name��value���ڷ���false ���򷵻� true
$redis->hGet('h', 'name');   //��ȡh����name�ֶ�value
$redis->hLen('h');      //��ȡh���ȣ����ֶεĸ���
$redis->hDel('h', 'email');   //ɾ��h���е�email�ֶ�
$redis->hKeys('h');   //��ȡh���������ֶ�
$redis->hVals('h');   //��ȡh���������ֶ�value
$redis->hGetAll('h');   //��ȡh���������ֶκ�value������һ���������飨�ֶ�Ϊ��ֵ��
$redis->hExists('h', 'email');   //�ж�email�ֶ��Ƿ�����ڱ�h�������ڷ���false
$redis->hSet('h', 'age', 28);
$redis->hIncrBy('h', 'age', -2);   //// ����h����age�ֶ�value��(-2) ���value�Ǹ�����ֵ �򷵻�false ���򣬷��ز������value
$redis->hIncrByFloat('h', 'age', -0.33);//����h����age�ֶ�value��(-2.6) ���value�Ǹ�����ֵ �򷵻�false ���򷵻ز������value(С���㱣��15λ)
$redis->hMset('h', array('score' => '80', 'salary' => 2000));// ��h ���������ֶκ�value
$redis->hMget('h', array('score', 'salary'));   // ��h ������ȡ�ֶε�value



//--------------------------Memcache��redis�Ա�--------------------------------










