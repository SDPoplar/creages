<?php
namespace App\Models;
//  use \Illuminate\Database\Eloquent\Builder as QueryBuilder;

/*
CREATE TABLE `ca_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `creator` int(10) unsigned NOT NULL COMMENT '项目创建人ID',
  `prod_name` varchar(64) NOT NULL COMMENT '项目名称',
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(3) unsigned NOT NULL DEFAULT 1 COMMENT '项目状态，1=正常，2=删除，3=异常（如违规等），4...（预留）',
  `summary` varchar(255) NOT NULL DEFAULT '' COMMENT '项目摘要（简要说明）',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '项目创建时间',
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp() COMMENT '最近一次编辑时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `creator` (`creator`,`prod_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目表';
*/

class Product extends \Illuminate\Database\Eloquent\Model
{
    use \App\Traits\Singleton;
    protected $table = 'ca_product';
    public $timestamps = false;

    public function &limitAuthor( string $userId ) : Product {
        $this->where( 'creator', $userId );
        return $this;
    }

    public function &noPrivate() : Product {
        $this->where( 'is_private', false );
        return $this;
    }

    public function getOffsetList( string $offset, int $size ) : \ArrayAccess {
        if( !empty( $offset ) ) {
            $this->where( 'id', '>', $offset );
        }
        if( $size > 0 ) {
            $this->limit( $size );
        }
        return $this->orderBy( 'id', 'desc' )->get() ?: [];
    }
}

