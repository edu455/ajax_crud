$(function () {
    fetch_all();
    let edit=false;
    $("#search").keyup(function() {
        let search = $("#search").val();
        if(search){
            $.ajax({
                url:'php_scripts/fetch_data.php',
                type: 'post',
                data: {search},
                success: function(response){
                    let data_array=JSON.parse(response);
                    let template='';
                    data_array.forEach(product =>{
                        template+= 
                        '<tr product_id'+product['product_id']+'>'+
                        '<td >'+product['product_id']+'</td>'+
                        '<td>'+product['product_name']+'</td>'+
                        '<td>'+product['product_description']+'</td>'+
                        '<td>'+product['product_supplier']+'</td>'+
                        '<td>'+product['product_amount']+'</td>'+
                        '<td>'+product['product_price_per_unit']+'</td>'+
                        '<td><button class="btn btn-primary product-edit" >Edit</button></td>'+
                        '<td><button class="delete_btn btn btn-danger ">Delete</button></td>'+
                        '</tr>'; 
                    });
                    $('#table_body').html(template);
                }
            });  
        }else{
            fetch_all();
        }
    });
    $(".test").click(function(){
        alert('dsa');
    })
    $('#product_form').submit(function(e){
        console.log(edit);
        if(edit){
            let product_data={
                id: $('#product_id').val(),
                name: $('#name').val(),
                description: $('#description').val(),
                supplier: $('#supplier').val(),
                amount: $('#amount').val(),
                price_per_unit: $('#price').val()
            };
            $.post('php_scripts/edit_data.php',product_data,function(e){
                console.log("dsada");
            });
            edit=false;
        }else{
            let product_data={
                name: $('#name').val(),
                description: $('#description').val(),
                supplier: $('#supplier').val(),
                amount: $('#amount').val(),
                price_per_unit: $('#price').val()
            };
            $.post('php_scripts/add_data.php',product_data,function(e){
                console.log(e);
                edit=false;
            });
        }
        e.preventDefault();
        fetch_all();
        $('#product_form').trigger('reset');

    });
    
    function fetch_all(){
        $.ajax({
            url:'php_scripts/fetch_all.php',
            type: 'get',
            success: function(response){
                let data_array=JSON.parse(response);
                let template='';
                data_array.forEach(product =>{
                    template+= 
                    '<tr product_id='+product['product_id']+'>'+
                    '<td >'+product['product_id']+'</td>'+
                    '<td>'+product['product_name']+'</td>'+
                    '<td>'+product['product_description']+'</td>'+
                    '<td>'+product['product_supplier']+'</td>'+
                    '<td>'+product['product_amount']+'</td>'+
                    '<td>'+product['product_price_per_unit']+'</td>'+
                    '<td><button class="btn btn-primary product-edit" >Edit</button></td>'+
                    '<td><button class="delete_btn btn btn-danger ">Delete</button></td>'+
                    '</tr>'; 
                });
                $('#table_body').html(template);
            }
        });
    }
    $(document).on('click','.delete_btn',function(){
        let element= $(this)[0].parentElement.parentElement;
        let id=$(element).attr('product_id');
        console.log(id);
        $.ajax({
            url:'php_scripts/delete_data.php',
            type:'post',
            data: {id},
            success:function(response){
                console.log('Delete');
            }
        });
        fetch_all();
    });
    $(document).on('click','.product-edit',function(){
        let element=$(this)[0].parentElement.parentElement;
        let id=$(element).attr('product_id');
        console.log(id);
        $.ajax({
            url:'php_scripts/fetch_single_data.php',
            type:'post',
            data: {id},
            success:function(response){
                const product=JSON.parse(response);
                console.log(product);
                $('#product_id').val(product.product_id);
                $('#name').val(product.product_name);
                $('#description').val(product.product_description);
                $('#supplier').val(product.product_supplier);
                $('#amount').val(product.product_amount);
                $('#price').val(product.product_price_per_unit);
                edit=true;
                console.log(product['product_name']);
                console.log(edit);
            }
        })
    });
});