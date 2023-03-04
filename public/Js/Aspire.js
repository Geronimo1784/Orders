var Tmpp = [];
var ARS = [];
var ARSUP = [];
var Sect = 0;

const formatterPeso = new Intl.NumberFormat('es-CO', {
    style: 'currency',
    currency: 'COP',
    minimumFractionDigits: 0
});

var an = {

    Color : () => {
        var simbolos, color;
        simbolos = "6789ABCDEF";
        color = "#";
    
        for(var i = 0; i < 6; i++){
            color = color + simbolos[Math.floor(Math.random() * 10)];
        }
    
        return color;
    },

    Dit : (a) => {
     
        $("." + a).on("click", function(){

            dt = $(this).attr("data-code");

            itr = document.getElementById("Tit_"+Sect);

            if(itr){
                itr.style.borderRight = '1px dashed #FFFFFF';
                itr.style.borderBottom = '1px dashed #FFFFFF';                 
            }

            itr = document.getElementById("Tit_"+dt);
            itr.style.borderRight = '1px dashed #00c42a';
            itr.style.borderBottom = '1px dashed #00c42a'; 
            Sect = dt;

        });
    },

    Val_inp : (a) =>{

        var state = true;
        form = document.getElementById(a);

        if (form !=null){
            for (var i = 0; i < form.length; i++){
                Requed = form[i].getAttribute("data-required");
                form[i].style.border = '1px solid var(--Vd-m)';
                if(Requed == "true"){
                    if(form[i].value == ""){
                        state = false;
                        form[i].style.border = '1px dashed #FF5555';
                    }
                }
            }
            if(state){
                return true;
            }
        }
    },

    val_msg : (formulario, title, Msg, type) =>{

        var state = true;
        form = document.getElementById(formulario);

        if (form !=null){
            for (var i = 0; i < form.length; i++){
                Requed = form[i].getAttribute("data-required");
                form[i].style.border = '1px solid #01BB01';
                if(Requed == "true"){
                    if(form[i].value == ""){
                        state = false;
                        form[i].style.border = '1px dashed #FF5555';
                    }
                }
            }
            if(!state){
                Swal.fire({
                    title: 'Debes completar los campos que son obligatorios.',
                    icon: 'error',
                    confirmButtonText: 'Completar',
                    showCloseButton: true
                });
                return
            }else{
                Swal.fire({
                    title: title, 
                    text: Msg, 
                    icon: type,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(formulario).submit();
                    }
                })
            }
        }
    },

    show_modal : (a ,modal, box) => {

        $("." + a).on("click", function(){
            $("." + modal).show();
            $("." + box).show();
        });

    },

    show_details : (a ,modal, box, code) => {

        $("." + a).on("click", function(){
            $("." + modal).show();
            $("." + box).show();
            dt = $(this).attr("data-code");
            di = $(this).attr("data-img");
            $('#img-details').attr('src', '');
            $('#Ttdtl').html('');
            $('#dsdtl').html('');
            $('#Isdtl').html('');
            document.getElementById('djoys').innerHTML = '1';
            $.ajax({
                type:"GET",
                url: 'Detail-item'+'/'+dt,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },   
                success: function (data) {

                    $('#img-details').attr('src', di);
                    $('#Ttdtl').html(data[0].title);
                    $('#dsdtl').html(data[0].description);
                    $('#Isdtl').html(data[0].Ingredients);
                    Jpp = {
                        'code' : data[0].Coding,
                        'titu' : data[0].title,
                        'imag' : data[0].image, 
                        'prec' : data[0].Price,
                        'desc' : data[0].descuento
                    }
                    
                    console.log(data);
                    console.log(Jpp.code);

                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });



        });

    },

    HideM : (a ,modal, box, code) => {

        $("." + a).on("click", function(){ 

            $("." + modal).hide();
            $("." + box).hide();
            $("#djoys").html('1');
        });

    },

    Hc : (a ,modal, box, code) => {

        $("." + a).on("click", function(){ 

            $("." + modal).hide();
            $("." + box).hide();
            location.reload();
        });

    },
    //Increm number items.
    inc : (a) => {
        $(a).on("click", function(){
            tx = $("#djoys").html();
            tx = ++ tx;
            an.fi('djoys', tx);                
        });
    },

    //decrement number items.
    dec : (a) => {
        $(a).on("click", function(){
            tx = $("#djoys").html();
            tx != 1 ? tx = -- tx : tx = 1 ;   
            an.fi('djoys', tx);                
        });
    },

    fi : (i,f) => {
        document.getElementById(i).innerHTML = f;
    },

    Clst : (Cook, Data) =>{
        window.localStorage.setItem(Cook, JSON.stringify(Data));
    },

    addi: (a) =>{
        $(a).on("click", function(){
            Stp = localStorage.getItem('Pedido'); 
            JStp = JSON.parse(Stp);
            std = false;

            Items = {            
                'Codigo' : Jpp.code,
                'Item' : Jpp.titu,
                'Imagen' : Jpp.imag,
                'Precio' : Jpp.prec, 
                'Cantidad': document.getElementById('djoys').innerHTML,          
                'Descuento' : 0,
            } 
            
            if(JStp){ //Si existe elementos
                
                ARSUP = JStp;

                for (var i = 0; i < ARSUP.length; i++) {
                    if(ARSUP[i].Codigo === Jpp.code ){ //Si existe el item con el codigo del articulo que hemos seleccionado ; sino exite, agrega un nuevo items.
                        std = true;
                        Fc = ARSUP[i]['Cantidad'];
                        sm = parseInt(Fc) + parseInt(document.getElementById('djoys').innerHTML);
                        ARSUP[i]['Cantidad'] = sm;
                    } 
                }

                if(!std){
                    ARSUP.push( Items);
                    Sup_der("se ha agregado un producto a tu carrito de compras", 2400, 'success');                    
                }else{
                    Sup_der("se ha Actualizado un producto a tu carrito de compras", 2400, 'success');                    
                }

                an.Clst("Pedido", ARSUP);
                
            }else{


                
                ARSUP.push( Items );
                an.Clst("Pedido", ARSUP);
                Sup_der("se ha agregado un producto a tu carrito de compras", 2400, 'success');

            }            
            
            an.Rstc('Nicrt');

/*             ARS.push({ [Jpp.code] : Items });
            window.localStorage.setItem("Pedido", JSON.stringify(ARS));


            Sup_der("se ha agregado un producto a tu carrito de compras", 2400, 'success'); */

        });
    },

    Rstc : (a)=>{

        Stp = localStorage.getItem('Pedido'); 
        JStp = JSON.parse(Stp);

        if(JStp){                        
            document.getElementById(a).innerHTML = JStp.length;
        }else{
            document.getElementById(a).innerHTML = "0";                              
        }

    },
    
    Rct : (a)=>{
        $(a).on("click", function(){
            an.Cciu();
        });
    },

    //Refresh Draw Carrito
    Cciu : ()=>{

        el = localStorage.getItem('Pedido'); 
        Jel = JSON.parse(el);
        var Tt = 0;
        var dsc = 0;
        $("#Body_cart div").remove();
            if(Jel){
                if(Jel.length > 0){
                    for (let i = 0; i < Jel.length; i++) {
                        Tt = parseInt(Jel[i]['Precio']* Jel[i]['Cantidad']) + Tt;
                        $("#Body_cart").append("<div class='ffp dsf bdr-10 Pd-15'>"+
                        "<img class='bdr-7' src='http://storing.imgs.com/"+ Jel[i]['Imagen'] +"' alt='image'  height='80'  width='80'>"+
                        "<div> <div class='Pl-20 Pb-5 ta2  fsa-15 tex-g7'>"+ Jel[i]['Item'] +"</div>"+
        /*                     "<div class='Pl-20'> <span class='sp-cant'>Cantidad : "+ Jel[i]['Cantidad'] +"</span> </div>"+ */
                        "<div class='Pl-20 Joys-carr'> <div class='Pd-3 dell' data-code='"+Jel[i]['Codigo']+"' > <img src='/Imgs/Clients/Icon-delete.jpg' alt='image' height='30' width='30'> </div> <div class='Pd-5'></div>  <div data-push='"+Jel[i]['Codigo']+"' class='Joicl Pul'>-</div> <div class='Joinp' id='inp_"+Jel[i]['Codigo']+"'> "+ Jel[i]['Cantidad'] +"</div> <div class='Joicr Pull' data-push='"+Jel[i]['Codigo']+"' >+</div></div>"+
                        "<div class='Pl-20 Pt-5 Pb-5 ta2 fsa-15 tn tex-g8 fwa-60'>"+ formatterPeso.format(parseInt(Jel[i]['Precio']* Jel[i]['Cantidad'])) +"</div>"+
                        "</div> </div> <div class='divider'></div> ");
                    }

                    $("#Body_cart").append("<div class='divider-T'></div><div class='Pd-10'>"+ 
                    "<div class='dsf tex-g7 fsa-14 Pd-10'> <div class='w-18'>Subtotal</div> <div class='w-18 tar'>"+formatterPeso.format( Tt ) + "</div> </div>"+   
                    "<div class='divider'></div>"+             
                    "<div class='dsf tex-g7 fsa-14 Pd-10'> <div class='w-18'>Descuentos</div> <div class='w-18 tar'>"+formatterPeso.format( dsc ) + "</div> </div>"+
                    "<div class='divider'></div>"+
                    "<div class='dsf tex-g9 fsa-15 fwa-60 Pd-10'> <div class='w-18'>TOTAL</div> <div class='w-18 tar'>"+formatterPeso.format(Tt)+"</div> </div>"+                
                    "<div class='Pd-5'></div>"+
                    "<div class='tac btn-buy ffp fsa-15 poin'> Realizar Pedido  </div>"+    
                    "<div class='Pd-10'></div>"+            
                    "</div>");
                }
            }else{
                    $("#Body_cart").append("<div class='Jdcc'>"+
                    "<div class='Pd-10'>"+
                    "<img style='opacity : 3' src='/Imgs/Clients/Parrilla_Vacia.png' alt='' width='200'>"+
                    "<div class='tex-g5 fsa-16 Pd-10 tac'>¡Tu carrito está vacio!</div>"+
                    "</div></div>");
                }

        an.Updic(".Pull");   
        an.Updicd(".Pul");   
        an.eim('.dell');
        an.show_modal('btn-buy', 'SMSP', 'Box_CC');         
        //an.pcd('.btn-buy'); 

    },

    //Eliminar Items
    eim : (a) => {
        $(a).on("click", function(){
            dt = $(this).attr("data-code");
            el = localStorage.getItem('Pedido'); 
            const Jes = JSON.parse(el);
            const Rod = Jes.filter( Elem => Elem.Codigo != dt ); 

            if(Rod.length === 0){
                localStorage.removeItem('Pedido');         
            }else{
                an.Clst("Pedido", Rod);
            }

            an.Cciu();
            an.Rstc('Nicrt');

            
        }); 
    },

    Updic : (a)=>{
        $(a).on("click", function(){
            dp = $(this).attr("data-push");
            var iny = document.getElementById("inp_"+dp);
            di = iny.innerHTML;

            if( parseInt(di) >= 50 ){
                iny.innerHTML = 50;
            }else{
                iny.innerHTML = parseInt(di) + 1;    
                
                Rfd = localStorage.getItem('Pedido'); 
                JRfd = JSON.parse(Rfd);
    

                for (var i = 0; i < JRfd.length; i++) {
                    if(JRfd[i].Codigo === dp ){
                        Fr = JRfd[i]['Cantidad'];
                        smr = parseInt(Fr) + 1;
                        JRfd[i]['Cantidad'] = smr;
                    } 
                }

                an.Clst("Pedido", JRfd);

            }
            an.Cciu();
        });
    },

    Updicd : (a)=>{
        $(a).on("click", function(){
            dp = $(this).attr("data-push");
            var iny = document.getElementById("inp_"+dp);
            di = iny.innerHTML;
            
            if( parseInt(di) <= 1 ){
                iny.innerHTML = 1;
            }else{

                iny.innerHTML = parseInt(di) - 1;         
                Rfd = localStorage.getItem('Pedido'); 
                JRfd = JSON.parse(Rfd);

                for (var i = 0; i < JRfd.length; i++) {
                    if(JRfd[i].Codigo === dp ){
                        Fr = JRfd[i]['Cantidad'];
                        smr = parseInt(Fr) - 1;
                        JRfd[i]['Cantidad'] = smr;
                    } 
                }
                an.Clst("Pedido", JRfd);
            }
            an.Cciu();
        });
    },

    SVPD : (a) =>{
        $(a).on("click", () => {    
            Vl = an.Val_inp('Pedido');
            if(Vl){

                $('#add').hide();
                $('#Send').show();

                el = localStorage.getItem('Pedido'); 
                Jel = JSON.parse(el);
                Qt = { 
                    name : 'Victor',
                    doc : '10784463',
                    tab : '5'
                }

                if(Jel.length > 0){

                    $.ajax({
                        type:"POST",
                        url: '/Save-Pedido',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            "Props" : Qt,
                            "items" : Jel
                        },    
                        success: function (data) {
                            if(data.state == "OK"){
                                $('#Send').hide();
                                $('#MsgOk').show();
                                $('#Code_pedido').html(data.Code); 
                                localStorage.removeItem('Pedido');     

                                $.ajax({
                                    type:"POST",
                                    url: 'http://127.0.0.1:8000/api/greeting',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: { 
                                        "Pedido" : {
                                                data
                                            }
                                        },    
                                    success: function (data) {
                                        
                                        console.log(data);
            
                                    },
                                    error: function (xhr) {
                                        console.log(xhr);
                                    }
                                }); 
                                


                            }
                            console.log(data);

                        },
                        error: function (xhr) {
                            console.log(xhr);
                        }
                    });                    
                
                }
                

            }
        });
    },
}

window.Sup_der = async function(msg, time , type) {
    return await Swal.fire({
        text: msg,
        icon: type,
        toast: true,
        buttonsStyling: false,
        showConfirmButton: false,
        position: "top-right",
        timerProgressBar: true,
        timer: time,
        animation: true,
        didOpen: (toast) => {
            //toast.addEventListener('mouseenter', Swal.stopTimer);
            //toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
};






