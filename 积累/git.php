<?php
/*配置git
 *  git config命令的--global参数，用了这个参数，表示你这台机器上所有的Git仓库都会使用这个配置，当然也可以对某个仓库指定不同的用户名和Email地址。因为Git是分布式版本控制系统，所以，每个机器都必须自报家门：你的名字和Email地址
        $ git config --global user.name "Your Name"
        $ git config --global user.email "email@example.com"
*/


/*创建版本库
 *   $ mkdir  myrepos       //创建版本库目录
 *   $ cd myrepos           //切换到版本库目录
 *   $ git init             //把这个目录变成Git可以管理的仓库：   目录下会多一个.git的目录
 *   创建新文件abc.txt
 *   $ git add abc.txt      //git add告诉Git，把文件添加到仓库   git add把文件添加进去，实际上就是把文件修改添加到暂存区；
 *   $ git commit -m "wrote a abc"      //git commit告诉Git，把文件提交到仓库   git commit提交更改，实际上就是把暂存区的所有内容提交到当前分支。
 *   
 */


/*版本时光穿梭
 * git status    // 命令可以让我们时刻掌握仓库当前的状态
 * git diff      // 查看具体修改了什么内容
 * git log --pretty=oneline     //显示从最近到最远的提交日志
 * git reset --hard HEAD^       //把当前版本回退到上一个版本，就可以使用git reset命令, HEAD指向的版本就是当前版本，
 * git reset --hard ($commit id)    //$commit id 版本号，回退到某个版本只需要写前几位就行了
 * git reflog        //用来记录你的每一次命令
 */
 
/*撤销修改
 * $ git checkout -- abc.txt
 * 命令git checkout -- abc.txt意思就是，把abc.txt文件在工作区的修改全部撤销，这里有两种情况：
                            一种是readme.txt自修改后还没有被放到暂存区，现在，撤销修改就回到和版本库一模一样的状态；
                            一种是readme.txt已经添加到暂存区后，又作了修改，现在，撤销修改就回到添加到暂存区后的状态。
         总之，就是让这个文件回到最近一次git commit或git add时的状态。
   git checkout -- file命令中的--很重要，没有--，就变成了“切换到另一个分支”的命令
        场景1：当你改乱了工作区某个文件的内容，想直接丢弃工作区的修改时，用命令git checkout -- file。
        场景2：当你不但改乱了工作区某个文件的内容，还添加到了暂存区时，想丢弃修改，分两步，第一步用命令git reset HEAD file，就回到了场景1，第二步按场景1操作。
 */
 
/*
 * 删除文件
 * 确实要从版本库中删除该文件，那就用命令
 *      git rm     删掉，并且
 *      git commit   
 * 另一种情况是删错了，因为版本库里还有呢
 *      git checkout -- abc.txt
 */
 
/*远程仓库
 * 1.
 * $   ssh-keygen -t rsa -C "youremail@example.com"
 * 可以在用户主目录里找到.ssh目录，里面有id_rsa和id_rsa.pub两个文件，这两个就是SSH Key的秘钥对，id_rsa是私钥，不能泄露出去，id_rsa.pub是公钥，可以放心地告诉任何人s
 * 2.
 * 登陆GitHub，打开“Account settings”，“SSH Keys”页面：然后，点“Add SSH Key”，填上任意Title，在Key文本框里粘贴id_rsa.pub文件的内容：
 * GitHub允许你添加多个Key。假定你有若干电脑，你一会儿在公司提交，一会儿在家里提交，只要把每台电脑的Key都添加到GitHub，就可以在每台电脑上往GitHub推送了
 * 
 * 3.
 * git remote add origin git@github.com:huanleyan/myrepos.git        //要关联一个远程库
 * 把上面的huanleyan替换成你自己的GitHub账户名
 * 添加后，远程库的名字就是origin，这是Git默认的叫法，也可以改成别的，但是origin这个名字一看就知道是远程库。
 * git push -u origin master      //第一次推送master分支的所有内容；
 * 用git push命令，实际上是把当前分支master推送到远程。由于远程库是空的，我们第一次推送master分支时，加上了-u参数，Git不但会把本地的master分支内容推送的远程新的master分支，还会把本地的master分支和远程的master分支关联起来，在以后的推送或者拉取时就可以简化命令。
 * git push origin master
 * 把本地master分支的最新修改推送至GitHub，现在，你就拥有了真正的分布式版本库！
 */
 

/*
 * git clone git@github.com:michaelliao/gitskills.git     //git克隆一个本地库
 */
 

/*  分支操作
 * $ git branch dev            //创建分支
 * $ git checkout dev          //切换分支dev
 * $ git branch                //列出所有分支，当前分支加*
 * $ git checkout master      //切换分支master
 * $ git merge dev            //把dev分支的工作成果合并到master分支上，注意：只有切换到master分支，才能合并分支
 * $ git branch -d dev        //删除dev分支
 */
 
/*解决冲突
 * git merge dev   出现冲突的时候
 * Git用<<<<<<<，=======，>>>>>>>标记出不同分支的内容，我们修改如下后保存：
 * 修改之后
 * $ git add abc.txt 
 * $ git commit -m "conflict fixed"
 * $ git log --graph --pretty=oneline --abbrev-commit    //查看分支的合并情况       git log --graph命令可以看到分支合并图。
 */
 

/*分支策略
 * 在实际开发中，我们应该按照几个基本原则进行分支管理：
       首先，master分支应该是非常稳定的，也就是仅用来发布新版本，平时不能在上面干活；
      那在哪干活呢？干活都在dev分支上，也就是说，dev分支是不稳定的，到某个时候，比如1.0版本发布时，再把dev分支合并到master上，在master分支发布1.0版本；
      你和你的小伙伴们每个人都在dev分支上干活，每个人都有自己的分支，时不时地往dev分支上合并就可以了。
      所以，团队合作的分支看起来就像这样：
  https://cdn.liaoxuefeng.com/cdn/files/attachments/001384909239390d355eb07d9d64305b6322aaf4edac1e3000/0
 */
 

/*bug分支
 * 软件开发中，bug就像家常便饭一样。有了bug就需要修复，在Git中，由于分支是如此的强大，所以，每个bug都可以通过一个新的临时分支来修复，修复后，合并分支，然后将临时分支删除。
 * 场景：当你接到一个修复一个代号101的bug的任务时，很自然地，你想创建一个分支issue-101来修复它，但是，等等，当前正在dev上进行的工作还没有提交
 * git stash        //可以把当前工作现场“储藏”起来，等以后恢复现场后继续工作
 * git status    --查看工作区是否干净
 * 首先确定要在哪个分支上修复bug，假定需要在master分支上修复，就从master创建临时分支：
 * git checkout master      切换到master分支
 * git checkout -b issue-101     创建101bugfix分支，并切换大101bugfix分支
 * 修复之后 提交
 * git add .
 * git commit -m ""
 * 修复完成后，切换到master分支，并完成合并，最后删除issue-101分支：
 * git checkout master
 * git merge --no-ff -m "merged bug fix 101" issue-101
 * git branch -d issue-101
 * 
 * 太棒了，原计划两个小时的bug修复只花了5分钟！现在，是时候接着回到dev分支干活了！
 * $ git checkout dev     //切换到dev分支
 * $ git stash list       //查看  刚才的dev工作现场存到哪去了
 * $ git stash pop        //恢复工作现场的同时把stash内容也删了
 */
 


/*Feature分支
 * 软件开发中，总有无穷无尽的新的功能要不断添加进来。 添加一个新功能时，你肯定不希望因为一些实验性质的代码，把主分支搞乱了，所以，每添加一个新功能，最好新建一个feature分支，在上面开发，完成后，合并，最后，删除该feature分支。
 * 现在，你终于接到了一个新任务：开发代号为Vulcan的新功能，该功能计划用于下一代星际飞船。
 * $ git checkout -b feature-vulcan        //创建并切换到新功能分支
 * 提交
 * git add
 * git commit -m ""
 * 切回开发分支
 * git checkout dev    //切回开发分支
 * git merge feature-vulcan     //新特性添加到开发分支    如果不行合并   git branch -D feature-vulcan   删除新特性分支
 */
 
/*多人协作
 * 当你从远程仓库克隆时，实际上Git自动把本地的master分支和远程的master分支对应起来了，并且，远程仓库的默认名称是origin。
 * 要查看远程库的信息，用git remote：
 * git remote -v
 * 推送分支，就是把该分支上的所有本地提交推送到远程库。推送时，要指定本地分支，这样，Git就会把该分支推送到远程库对应的远程分支上：
 * $ git push origin master
 * 如果要推送其他分支，比如dev，就改成：
 * $ git push origin dev
 * 但是，并不是一定要把本地分支往远程推送，那么，哪些分支需要推送，哪些不需要呢？
 *  master分支是主分支，因此要时刻与远程同步；
    dev分支是开发分支，团队所有成员都需要在上面工作，所以也需要与远程同步；
    bug分支只用于在本地修复bug，就没必要推到远程了，除非老板要看看你每周到底修复了几个bug；
    feature分支是否推到远程，取决于你是否和你的小伙伴合作在上面开发。
            总之，就是在Git中，分支完全可以在本地自己藏着玩，是否推送，视你的心情而定！
 *
 *
 *抓取分支
 *多人协作时，大家都会往master和dev分支上推送各自的修改。
 *场景：现在，模拟一个你的小伙伴，可以在另一台电脑（注意要把SSH Key添加到GitHub）或者同一台电脑的另一个目录下克隆：/
 *git clone git@github.com:huanleyan/myrepos.git
 *git branch    ------------，默认情况下，你的小伙伴只能看到本地的master分支
 *你的小伙伴要在dev分支上开发，就必须创建远程origin的dev分支到本地，于是他用这个命令创建本地dev分支：
 *git checkout -b dev origin/dev    
 *git add git commit -m ""
 *git push origin dev    //在dev上继续修改，然后，时不时地把dev分支push到远程
 *
 *