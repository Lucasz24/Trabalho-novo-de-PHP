<?php
    class Router {
        private array $routes;

        public function __construct() {
            $this->routes = [
                'GET' => [
                    '/usuarios' => [
                        'controller' => 'UsuarioController',
                        'function' => 'getUsuarios'
                    ],
                    '/status' => [
                        '/controller' => 'statusController',
                        'function' => 'getStatus'
                    ],
                    '/produto' => [
                        'controller' => 'produtoController',
                        'function' => 'getProdutos'
                    ],
                    '/pedidos' => [
                        'controller' => 'pedidoController',
                        'function' => 'getPedido'
                    ]

                    
                ],
                'POST' => [
                    '/usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'getUsuarios'
                    ],
                    '/cadastrar-Usuario' => [
                    'controller' => 'UsuarioController',
                    'function' => 'createUsuario'
                    ],
                    '/status' => [
                        'controller' => 'statusController',
                        'function' => 'GetStatusById'
                    ],
                    '/buscar-Produtos' => [
                        'controller' => 'ProdutoController',
                        'function' => 'BuscarProdutos'
                    ],
                    '/cadastrar-produtos' => [
                        'controller' => 'ProdutoController',
                        'function' => 'createProduto'
                    ],
                    '/item-pedido' => [
                        'controller' => 'itemPedidoController',
                        'function' => 'GetPedidoById'
                    ],
                    '/cadastrar-item-pedido' => [
                        'controller' => 'itemController',
                        'function' => 'CreatePedido'
                    ],
                    '/pedido' => [
                        'controller' => 'pedidoController',
                        'function' => 'BuscarPedidos'
                    ],
                    '/pedido-pessoa' => [
                        'controller' => 'pedidoController',
                        'function' => 'getPedidoPessoa'
                    ],
                    '/cadastrar-pedido' => [
                        'controller' => 'pedidoController',
                        'function' => 'cadastrarPedido'
                    ],
                    '/valor-total-pedido' => [
                        'controller' => 'pedidoController',
                        'function' => 'valorTotalPedido'
                    ],
                    '/buscar-Usuarios' => [
                        'controller' => 'UsuarioController',
                        'function' => 'getUsuarios'
                    ]
                    


                ],
                'PUT' => [
                    '/editar-usuario' => [
                        'controller' => 'usuarioController',
                        'function' => 'editarUsuario'
                    ],
                    '/editar-produto' => [
                        'controller' => 'produtoController',
                        'function' => 'editarProduto'
                    ],
                    '/editar-item-pedido' => [
                        'controller' => 'pedidoController',
                        'function' => 'editarItemPedido'
                    ],
                    '/editar-pedido' => [
                        'controller' => 'pedidoController',
                        'function' => 'editarPedido'
                    ],
                    '/editar-status-pedido' => [
                        'controller' => 'pedidoController',
                        'function' => 'editarStatusPedido' 
                    ]
                ],
                'DELETE' => [
                    '/excluir-usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'deleteUsuario'
                    ],
                    '/excluir-produto' => [
                        'controller' => 'produtoController',
                        'function' => 'deleteProduto'
                    ],
                    '/excluir-item-pedido' => [
                        'controller' => 'pedidoController',
                        'function' => 'deleteItemPedido'
                    ],
                    '/excluir-pedido' => [
                        'controllers' => 'pedidoController',
                        'function' => 'deletePedido'
                    ]
                ]
            ];
        }

        public function handleRequest(string $method, string $route): string {
            $routeExists = !empty($this->routes[$method][$route]);

            if (!$routeExists) {
                return json_encode([
                    'error' => 'Essa rota não existe!',
                    'result' => null
                ]);
            }

            $routeInfo = $this->routes[$method][$route];

            $controller = $routeInfo['controller'];
            $function = $routeInfo['function'];

            require_once __DIR__ . '/../controllers/' . $controller . '.php';

            return (new $controller)->$function();
        }
    }
?>