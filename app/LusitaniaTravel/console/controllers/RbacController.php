<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $roles = [
            'administrador' => 'Admin',
            'funcionario' => 'Funcionário',
            'fornecedor' => 'Fornecedor',
            'cliente' => 'Cliente',
        ];

        $permissions = [
            'criarAlojamentos' => 'Criar Alojamentos',
            'editarAlojamentos' => 'Editar Alojamentos',
            'verAlojamentos' => 'Ver Alojamentos',
            'eliminarAlojamentos' => 'Eliminar Alojamentos',
            'criarReservas' => 'Criar Reservas',
            'editarReservas' => 'Editar Reservas',
            'verReservas' => 'Ver Reservas',
            'eliminarReservas' => 'Eliminar Reservas',
            'confirmarReserva' => 'Confirmar Reserva',
            'reservarOnline' => 'Reservar Online',
            'adicionarcarrinhoCompras' => 'Adicionar ao Carrinho de Compras',
            'consultarFaturas' => 'Consultar Faturas',
            'adicionarFavoritos' => 'Adicionar aos Favoritos',
            'classificarecomentarAlojamentos' => 'Classificar e Comentar Alojamentos',
            'pagarReserva' => 'Pagar Reserva',
            'reservarPresencial' => 'Reservar Presencialmente',
            'emitirFaturas' => 'Emitir Faturas',
            'calcularValoresIva' => 'Calcular Valores do IVA',
            'gerarRelatorios' => 'Gerar Relatórios',
            'visualizarRelatorios' => 'Visualizar Relatórios',
            'criarClientes' => 'Criar Clientes',
            'editarClientes' => 'Editar Clientes',
            'verClientes' => 'Ver Clientes',
            'eliminarClientes' => 'Eliminar Clientes',
        ];

        $this->createRoles($auth, $roles);
        $this->createPermissions($auth, $permissions);
        $this->assignPermissionsToRoles($auth);

        echo "RBAC configuration completed.\n";
    }

    private function createRoles($auth, $roles)
    {
        foreach ($roles as $roleName => $roleDescription) {
            $role = $auth->createRole($roleName);
            $auth->add($role);
        }
    }

    private function createPermissions($auth, $permissions)
    {
        foreach ($permissions as $permissionName => $permissionDescription) {
            $permission = $auth->createPermission($permissionName);
            $permission->description = $permissionDescription;
            $auth->add($permission);
        }
    }

    private function assignPermissionsToRoles($auth)
    {
        $rolePermissions = [
            'cliente' => ['reservarOnline', 'adicionarcarrinhoCompras', 'consultarFaturas', 'classificarecomentarAlojamentos', 'pagarReserva'],
            'funcionario' => ['reservarPresencial', 'criarReservas', 'editarReservas', 'verReservas', 'eliminarReservas', 'visualizarRelatorios', 'criarClientes', 'editarClientes', 'verClientes', 'eliminarClientes', 'calcularValoresIva'],
            'fornecedor' => ['confirmarReserva', 'criarAlojamentos', 'editarAlojamentos', 'eliminarAlojamentos', 'verAlojamentos'],
            'administrador' => ['emitirFaturas', 'gerarRelatorios', 'criarAlojamentos', 'editarAlojamentos', 'verAlojamentos', 'eliminarAlojamentos', 'criarReservas', 'editarReservas', 'verReservas', 'eliminarReservas', 'calcularValoresIva'],
        ];

        foreach ($rolePermissions as $roleName => $permissionNames) {
            $role = $auth->getRole($roleName);
            foreach ($permissionNames as $permissionName) {
                $permission = $auth->getPermission($permissionName);
                $auth->addChild($role, $permission);
            }
        }
    }

    public function actionAssignClienteRole($userId)
    {
        $auth = Yii::$app->authManager;
        $clienteRole = $auth->getRole('cliente');

        $user = User::findOne($userId);

        if ($clienteRole !== null && $user !== null && !$auth->checkAccess($user->id, $clienteRole->name)) {
            $auth->assign($clienteRole, $user->id);
            Yii::$app->session->setFlash('success', 'Papel de Cliente atribuído com sucesso.');
        } else {
            Yii::$app->session->setFlash('error', 'Falha ao atribuir o papel de Cliente.');
        }
    }
}

