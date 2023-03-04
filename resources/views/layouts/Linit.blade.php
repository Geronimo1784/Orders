<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="{{asset('css/Main.css')}}" />    
        <link rel="stylesheet" type="text/css" href="{{asset('css/Tables.css')}}" />    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


        <script src={{asset('Js/jquery.min.js')}}></script>
        <script src="{{asset('Js/Aspire.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title> Sistema de Restaurantes </title>
    </head>
    <body>

        <div id="Show-Modal-l" style="display: none; width: 100%; height: 100vh; background-color: #00000093; position: fixed; top: 0px; z-index: 200;"></div>
        <div id="Show-Modal-r" class="dsmr" style="display: none; width: 100%; height: 100vh; background-color: #00000093; position: fixed; top: 0px; z-index: 200;"></div>
        <div class="SMC" style="display: none; width: 100%; height: 100vh; background-color: #00000093; position: fixed; top: 0px; z-index: 200;"></div>
        <div class="SMSP" style="display: none; width: 100%; height: 100vh; background-color: #00000093; position: fixed; top: 0px; z-index: 1005;"></div>

        {{-- Modal Confirmar Compra --}}
        <div class="Sombra-3 Box_CC Pd-10">
            <div class="Jdcc">
                <div id="add" >
                    <div class="Pd-10"></div>
                    <div class="tac"><img src='/Imgs/img/Icons-carr_2.png' alt="" width="80"></div>
                    <div class="tac fsa-30 fwa-60">Realizar Pedido</div>
                    <div class="tac tex-g6 fsa-14 Pl-25 Pr-25 Pt-10">Ingresa los siguiente datos para crear tu orden de pedido.</div>
                    <div class="tac tex-g6 fsa-14 Pl-25 Pr-25">Todos los campos son obligatorios.</div>

                    <form id="Pedido" >
                        <div class="tac  Pl-25 Pr-25  ">
                            <div class=" Pl-25 Pr-25 Pt-10 "> <input type="text" id="Inp_1" data-required='true' class="form-control" placeholder="Escriba su nombre"> </div>
                        </div>

                        <div class="tac  Pl-25 Pr-25">
                            <div class=" Pl-25 Pr-25 Pt-10 dsf">  <input type="number" id="Inp_2" data-required='true' class="form-control" placeholder="Número de documento"> <div class="Pd-5"></div> <input type="number" id="Inp_3" data-required='true' class="form-control" placeholder="Número de tu mesa"> </div>
                        </div> 
                        <div class="Pd-10"></div>
                    </form>
                    <div class="Jdcc">
                        <div class="btn-buy-ca">Cancelar</div>
                        <div class="Pd-5"></div>
                        <div class="btn-buy-ok SVPD">Aceptar</div>

                    </div>
                </div>
                <div id="Send" class="dsn">
                    <div class="Pd-30"></div>
                    <div class="Pd-40"></div>
                    <div class="tac"><img style="border-radius: 50%;" src='/Imgs/Clients/gif-saved.gif' alt="" width="70"></div>
                    <div class="Pd-10 tex-g2 fsa-13 ">Enviando pedido...</div>

                </div>

                <div id="MsgOk" class="dsn tac">
                    <div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                        <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
                        <div class="swal2-success-ring"></div> 
                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                    </div>
                    <div class="Pd-5"></div>
                    <div class="tex-g6 fsa-30 fwa-60" >Pedido Ok!</div>
                    <div class="Pb-10">Su pedido ha sido registrado corectamente.</div>
                    <div id="Code_pedido" class="bga_az boder-2 brd-5 Pd-10 fwa-60 fsa-20 tex-g6"> 000-000 </div>
                    <div class="fsa-12" style="color: #ff004caf">Utilice este codigo para ver el estado de su pedido</div>

                    <div class="Jdcc Pd-20">
                        <div class="btn-buy-ok ClOk">Aceptar</div>
                    </div>


                </div>
            </div>            
        </div>

        {{-- Modal add Carriro --}}
        <div class="DP Sombra-3 Box_1024_768 Pd-10">
            {{-- <div id="Ttdtl" class="ffp fsa-19 Pl-20 fwa-60 tac"></div> --}}

            <div id="Ttdtl" class="ffp fsa-20 fwa-60 Pl-20 tex-g8" style="position: absolute; top: 20px; left: 30px;">Agregar producto al carrito </div>
            <div class="clos-m">
                <img src="{{ asset('Imgs/menu/close.png')}}" alt="" width="25"> 
            </div>
            <div class="Pd-25"></div>
            <div class="divider"></div>
            
            <div class="dsf Pd-20">
                <div class="tac" style="height: 550px; width: 450px"> 
                    <div class="Pd-10">
                        <img id="img-details" height="400"> 
                    </div>
                    <div class="Pd-5"></div>
                    <div class="Pd-10"></div>
                    <div class="WH-1 Just-c dsf">
                        <div class="dsf WH-100 Pl-20 Pr-20">
                            <div class="WH-40">
                                <div class="Joys-cant fsa-16">
                                    <div class="link-dec Joys-left">-</div>
                                    <div class="Joys-input" id="djoys">1</div>
                                    <div class="link-inc Joys-right">+</div>
                                </div>
                            </div>    
                            <div class="btn-adg AddToCart WH-60" data-code="{{ $item->lg }}">Agregar al carrito</div>
                        </div>
                    </div>
                 
{{--                     <div class="Pt-10 Pl-5 tal fwa-60 fsa-15">Descripción de producto</div>
                    <div id="dsdtl" class="Pl-5 taj tex-g5 fsa-13"></div> --}}
                </div>
                <div class="Pd-10"></div>
                <div style="height: 550px; width: 500px;">
                    <div  class="tac ffp fsa-19 fwa-60"></div>
                    <div class="Pr-20" style="width: 100%; height: 390px; border: 1px solid #ffffff">
                        <div class="Pd-15"></div>
                        <div class="Pl-10 tal fwa-60 fsa-16">Descripción de producto</div>
                        <div id="dsdtl" class="Pd-10 taj tex-g5 fsa-14"></div>
                        <div class="Pd-10"></div>
                        <div class="Pl-10 tal fwa-60 fsa-16">Ingredientes</div>
                        <div id="Isdtl" class="Pd-10 taj tex-g5 fsa-14"></div>
                    </div>
                    <div class="bgr-gr-s Pd-10 brd-5">
                        <div class="fsa-11 fwa-60 tex-g7 tar Pb-10 Pr-10">Nota pedido</div>
                        <textarea name="inpt_" placeholder="Puedes añadir una nota a tu pedido...!" class="form-control" rows="2"></textarea>

                    </div>
                </div>
            </div>

{{--             <div class="WH-100 Jdcc">
                <div class="btn-modal Save"> AGREGAR</div>
            </div> --}}
        </div>



        <div class="Sombra-3" style="height: 60px; background-color: #ffffff; z-index: 150; position: fixed; width: 100%;">
            <div class="container"> 
                <div class="Pl-30 Pr-30"> 
                    
                    {{-- Lado Izquerdo --}}
                    <div class="dsfr Just-l" style="width: 100%"> 
                        <div class="Min-menu WH-100">
                            <div class="dsf">
                                
                                <div class="h-35 WH-100 Pd-10">
                                    <div class="button" style="width: 40px">
                                        <img  src="/imgs/Clients/Icons-Menu-blackb.png" alt="" width="35">
                                    </div>
                                </div>

                                <div class="d-flex Pd-7 cart">
                                    <div class="btn btn-icon btn-color-white bg-hover-white bg-hover-opacity-10 w-30px h-30px h-40px w-40px position-relative" id="abrir_store">
                                        <div class="SCart"><img src="/Imgs/img/Icons-carr_2.png" alt="" width="35"></div>
                                        <div  style="text-align: center; font-size: 13px; font-weight: 700; color: #fff; width: 23px; height: 23px; background-color: #ff004c; position: absolute; top: -3px;left: 39px; border-radius: 15px;" id="Nicrt">20</div>
                                    </div>
                                </div>

                            </div>
                        </div> 
                    </div>
                </div> 
            </div>
        </div>


        <section>
            <div class="Pd-30"></div>

            {{-- Contenido dinamico página --}}
            @yield('content')
        </section> 



        {{-- Menu Izquierdo --}}

            <div class="mleft Sombra-m">
                <div style="background-color: #eeff00; width: 100%; height: 140px;">
                    <div class="dsf Pd-20" >
                        <div class="Sombra" style="width: 60px; height: 60px;border-radius: 50px;">
{{--                             <img src="/application/img/user_menu.png" alt="" width="60">
 --}}                        </div> 
                        <div class="Pd-3"></div>
                        <div class="Pd-10">
                            <div class="tex-g7 fsa-14">Hola, </div>
                            <div class="tex-g7 Pb-10"></div>
                            <div class="bgr-6 Pd-5 tac fsa-12" style="border-radius: 20px;"> Alcarbono.com
                            </div>
                        </div>
                    </div>
                </div>
                <div style="padding: 5px 25px">
                    <section>
                        @yield('Menu')
                    </section>  
                </div>
            </div>



        {{-- Menu Derecho --}}

        <div class="mright Sombra-m" style="overflow-y: scroll;">
            <div class="dsf Sombra-m" style="position: fixed; background-color: #ffffff; width: 100%; height: 60px;">
                <div class="dsf" style="width: 350px;">
                    <div class="Pd-15"><img class="dsmr" src="/Imgs/Clients/Not_carr.png" alt="" width="25"></div>
                    <div class="tn fsa-15 Pt-18">Mi carrito de compras</div>
                </div>
                <div class="Pd-15"><img class="dsmr poin"  style="opacity: 0.7" src="/Imgs/Clients/boton-cerrar.png" alt="" width="20"></div>
            </div>
            <div class="divider-N"></div>

            <div>
                <div style="height: 60px;"></div>
                <div id="Body_cart" ></div>
            </div>
        </div>



        <script>
          
            document.querySelector(".button").addEventListener("click", (e) => {
                e.stopPropagation();
                document.querySelector(".mleft").classList.add("slider_mleft");
                document.getElementById("Show-Modal-l").style.display = 'block';
            });

            document.querySelector(".cart").addEventListener("click", (e) => {
                e.stopPropagation();
                document.querySelector(".mright").classList.add("slider_right");
                document.getElementById("Show-Modal-r").style.display = 'block';
            });            
            
            document.addEventListener("click", (e) => {
                if (!e.target.classList.contains("mleft")) {
                    document.querySelector(".mleft").classList.remove("slider_mleft");
                    document.getElementById("Show-Modal-l").style.display = 'none';
                }
/*                 if (!e.target.classList.contains("mright")) {
                    document.querySelector(".mright").classList.remove("slider_right");
                    document.getElementById("Show-Modal-r").style.display = 'none';
                } */

                if (e.target.classList.contains("dsmr")) {
                    document.querySelector(".mright").classList.remove("slider_right");
                    document.getElementById("Show-Modal-r").style.display = 'none';
                }                
                
            });

            an.inc(".link-inc");
            an.dec(".link-dec");
            an.addi(".AddToCart");
            an.Rstc('Nicrt');
            an.Rct('.SCart'); 
            an.SVPD('.SVPD'); 
            an.Hc('ClOk', 'SMSP', 'Box_CC');  
            an.Dit("mex");
            
        
        </script>

        
        <style>
       
            .mleft {
                position: fixed;
                justify-content: center;
                align-items: center;
                color: #fff;
                top: 0px;
                left: -300%;
                width: 320px;
                height: 100vh;
                background: #fff;
                transition: all 0.5s;
                z-index: 1001;
            }
        
            .slider_mleft {
                left: 0%;
                display: block;
            }

            .mright {
                position: fixed;
                justify-content: center;
                align-items: center;
                color: #fff;
                top: 0px;
                left: 300%;
                width: 400px;
                height: 100vh;
                background: #fff;
                transition: all 0.5s;
                z-index: 1001;
            }

            .slider_right {
                left: Calc(100% - 400px);
                display: block;
            }

        </style>   

    </body>
</html>