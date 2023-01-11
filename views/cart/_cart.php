<?php foreach ($carts['data'] as $cart): ?>
    <div class="card card-xs" id="cart">
        <div class="thumb">
            <img src="<?= dist("images/vehicules/{$cart['image']}") ?>" alt="">
        </div>
        <div class="details">
            <div class="box">
                <h5 class="price" id="price-unit" price="<?= $cart['prix'] ?>"><?= $cart['prix'] ?>$</h5>
                <h6 class="title">
                    
                    <a 
                    href="<?= generate('store.eye', ['vehicule' => $cart['vehicule_id']]) ?>"  
                    class="cd-name"> 
                    <?= sprintf("%s %s", $cart['marque'], $cart['vehicule']) ?>
                    </a>
                </h6>
                <?= star($cart['star']) ?>
            </div>
            <div class="c-options">
                <div class="c-option">
                    <p id="stock" stock="<?= $cart['stock'] ?>"><?= $cart['stock'] ?> dans le stock</p>
                </div>
                <div class="c-option">
                    <label for="quantity">quantité</label>
                    <input type="number"  id="quantity" name="quentity-1" value="<?= $cart['quantite'] ?>">
                </div>
                <div class="c-option"><span id="price-total"></span></div>
        
                <div class="c-option ft-right">
                    <a href="" 
                    id="cart-remove" 
                    class="button button-sm button-danger">
                        <i class="fa fa-trash"></i>
                    </a> &emsp;
                    <a href="" 
                    id="cart-remove" 
                    class="button button-sm button-light">
                        <i class="fa fa-edit"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>