<?php

require_once 'bootstrap.php';

use \Payutc\Bom\Product;
use \Payutc\Db\Dbal;

class ProductRwdbTest extends DatabaseTest
{
	/**
	 * get db dataset
	 */
	public function getDataSet()
	{
        return $this->computeDataset(array(
            'products.yml',
            'categories.yml',
            'fundations.yml'
        ));
	}
    
    public function testDecStockById()
    {
        Product::decStockById(1, 4);
        $r = Product::getOne(1, 1);
        $this->assertEquals(6, $r['stock']);
    }
    
    public function testIncStockById()
    {
        Product::incStockById(1, 4);
        $r = Product::getOne(1, 1);
        $this->assertEquals(14, $r['stock']);
    }

    public function testAdd() {
        $a = Product::add("Chouffe", 1000, 180, 10, 1, null, 1);
        $r = Product::getOne($a["success"], 1);

        $this->assertEquals("Chouffe", $r['name']);
        $this->assertEquals(10, $r['stock']);
        $this->assertEquals(180, $r['price']);
        $this->assertEquals(1, $r['alcool']);
        $this->assertEquals(null, $r['image']);
        $this->assertEquals(1000, $r['categorie_id']);
        $this->assertEquals(1, $r['fundation_id']);
        
        $a = Product::edit($r["id"], "MC Chouffe", 1001, 170, 10, 1, null, 1);
        $r = Product::getOne($a["success"]);

        $this->assertEquals("MC Chouffe", $r['name']);
        $this->assertEquals(10, $r['stock']);
        $this->assertEquals(170, $r['price']);
        $this->assertEquals(1, $r['alcool']);
        $this->assertEquals(null, $r['image']);
        $this->assertEquals(1001, $r['categorie_id']);
        $this->assertEquals(1, $r['fundation_id']);

        $a = Product::edit($r["id"], "MC Chouffe", 1001, 170, 10, 0, null, 1);
        $r = Product::getOne($a["success"]);
        $this->assertEquals(0, $r['alcool']);

        $a = Product::delete($r["id"], 1);
        $z = Product::getOne($r["id"]);
        $this->assertEquals(null, $z);

        $r = Product::getOne($r["id"], 1, 1);
        $this->assertEquals("MC Chouffe", $r['name']);
        $this->assertEquals(10, $r['stock']);
        $this->assertEquals(170, $r['price']);
        $this->assertEquals(0, $r['alcool']);
        $this->assertEquals(null, $r['image']);
        $this->assertEquals(1001, $r['categorie_id']);
        $this->assertEquals(1, $r['fundation_id']);
    }
    
    /**
     * @depends testAdd
     */
    public function testDelete() {
        // add image
        $conn = Dbal::conn();
        $img_id = $conn->insert('ts_image_img', array(
                'img_mime' => 'jpg',
                'img_width' => 0,
                'img_length' => 0,
                'img_content' => ''));
        // create object
        $a = Product::add("Chouffe", 1000, 180, 10, 1, $img_id, 1);
        $id = $a["success"];
        // delete object
        Product::delete($id, 1);
        // assert we cant get the object now
        $r = Product::getOne($id, 1);
        $this->assertNull($r);
        // but we can get it if we allow deleted objects
        $r = Product::getOne($id, 1, 1);
        $this->assertNotNull($r);
        // check the price has been removed too
        $qb = Dbal::createQueryBuilder();
        $q = $qb->select('pri_removed')
                ->from('t_price_pri', 'pri')
                ->where('obj_id = :id')
                ->setParameter('id', $id);
        $prices = $q->execute()->fetchAll();
        foreach($prices as $p) {
            $this->assertEquals(1, $p['pri_removed']);
        }
        // check the image has been removed too
        $qb = Dbal::createQueryBuilder();
        $q = $qb->select('count(*) as count')
                ->from('ts_image_img', 'img')
                ->where('img_id = :id')
                ->setParameter('id', $img_id);
        $res = $q->execute()->fetch();
        $this->assertEquals(0, $res['count']);
    }
}



