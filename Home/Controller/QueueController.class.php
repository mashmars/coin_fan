<?php
namespace Home\Controller;
use Think\Controller;

class QueueController extends Controller
{

    /**
     * 钱包检查
     */
    public function qianbao()
    {
        Vendor("Move.ext.client");
        $client = new \client('a5c','543', '127.0.0.1', 31253, 5, [], 1);
        $json = $client->getinfo();

        if (!isset($json['version']) || !$json['version']) {
            echo '###ERR#####*****  connect fail  ***** ####ERR####>' . "\n";exit;
        }
        $listtransactions = $client->listtransactions('*', 100, 0);
        echo 'listtransactions:' . count($listtransactions) . "\n";
        krsort($listtransactions);
        echo '<pre>';
        //var_dump($listtransactions);exit;
        foreach ($listtransactions as $trans) {

            if (M('Myzr')->where(array('txid' => $trans['txid'], 'status' => '1'))->find()) {
                echo 'txid had found continue' . "\n";
                continue;
            }

            echo 'all check ok ' . "\n";

            if ($trans['category'] == 'receive') {
                //如果是接收的 通过账户获取用户信息
                if (!($user = M('user')->where(array('phone' => $trans['account']))->find())) {
                    echo 'no account find continue' . "\n";
                    continue;
                }
                print_r($trans);
                echo 'start receive do:' . "\n";
                $sfee = 0;
                $true_amount = $trans['amount'];

                //经过多少次确认
                if ($trans['confirmations'] < 5) {

                    echo 'confirmations <  c_zr_dz continue' . "\n";

                    if ($res = M('myzr')->where(array('txid' => $trans['txid']))->find()) {
                        M('myzr')->save(array('id' => $res['id'], 'addtime' => time(), 'status' => intval($trans['confirmations'] - 5)));
                    }else {
                        M('myzr')->add(array('userid' => $user['id'], 'address' => $trans['address'] , 'txid' => $trans['txid'], 'num' => $true_amount, 'createdate' => time(), 'status' => intval($trans['confirmations'] - 5)));
                    }

                    continue;
                }
                else {
                    echo 'confirmations full' . "\n";
                }

                $mo = M();
                $mo->startTrans();
                $rs = array();
                $rs[] = $mo->table('use_coin')->where(array('userid' => $user['id']))->setInc('lth', $trans['amount']);

                if ($res = $mo->table('myzr')->where(array('txid' => $trans['txid']))->find()) {
                    echo 'myzr find and set status 1';
                    $rs[] = $mo->table('myzr')->save(array('id' => $res['id'], 'createdate' => time(), 'status' => 1));
                }
                else {
                    echo 'myzr not find and add a new myzr' . "\n";
                    $rs[] = $mo->table('myzr')->add(array('userid' => $user['id'], 'address' => $trans['address'], 'txid' => $trans['txid'], 'num' => $true_amount, 'createdate' => time(), 'status' => 1));
                }

                if (check_arr($rs)) {
                    $mo->commit();
                    echo $trans['amount'] . ' receive ok '  . $trans['amount'];

                    echo 'commit ok' . "\n";
                }else {
                    echo $trans['amount'] . 'receive fail ' . $trans['amount'];

                    $mo->rollback();
                    print_r($rs);
                    echo 'rollback ok' . "\n";
                }
            }
            ///////转出
            if ($trans['category'] == 'send') {
                echo 'start send do:' . "\n";

                if (3 <= $trans['confirmations']) {
                    $myzc = M('Myzc')->where(array('address' => $trans['address']))->find();

                    if ($myzc) {
                        if ($myzc['status'] == 0) {
                            M('Myzc')->where(array('id' => $myzc['id']))->save(array('status' => 1,'txid'=>$trans['txid']));
                            echo $trans['amount'] . '成功转出币确定';
                        }
                    }
                }
            }
        }
    }
}