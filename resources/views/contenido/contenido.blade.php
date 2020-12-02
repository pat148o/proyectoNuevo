@extends('principal')

@section('contenido')

@if (Auth::check())


<template v-if= "menu==1">
    <cargos></cargos>
</template>

<template v-if= "menu==2">
    <clientes></clientes>
</template>

<template v-if= "menu==3">
    <empresa></empresa>
</template>

<template v-if= "menu==4">
    <empleados></empleados>
</template>

<template v-if= "menu==5">
    <ent_productos></ent_productos>
</template>

<template v-if= "menu==6">
    <factura></factura>
</template>

<template v-if= "menu==7">
    <mesas></mesas>
</template>

<template v-if= "menu==8">
    <pedidos></pedidos>
</template>

<template v-if= "menu==9">
    <productos></productos>
</template>

<template v-if= "menu==10">
    <prov_productos></prov_productos>
</template>

<template v-if= "menu==11">
    <proveedores></proveedores>
</template>

<template v-if= "menu==12">
    <sali_productos></sali_productos>
</template>


<template v-if= "menu==13">
    <tipo_productos></tipo_productos>
</template>

<template v-if= "menu==14">
    <users></users>
</template>



{{-- <template v-if= "menu==12">
    <detalle_salida></detalle_salida>
</template> --}}

{{-- <template v-if= "menu==13">
    <detalle_entrada></detalle_entrada>
</template> --}}



{{-- <template v-if= "menu==15">
    <detalle_pedidos></detalle_pedidos>
</template> --}}

{{-- <template v-if= "menu==16">
    <detalle_factura></detalle_factura>
</template> --}}



@endif


@endsection
