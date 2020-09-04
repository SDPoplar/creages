<?php
namespace App\Services;

class Product
{
    use \App\Traits\Singleton;

    public function getListByUser( string $userId, bool $publicOnly = false ) : array {
        $finder = \App\Models\Product::GetInstance()->limitAuthor( $userId );
        if( $publicOnly ) {
            $finder->noPrivate();
        }
        foreach( $finder->getOffsetList( '', 0 ) as $item ) {
            $ret[] = \App\Instances\Product::FromData( $item );
        }
        return $ret ?? [];
    }
}

