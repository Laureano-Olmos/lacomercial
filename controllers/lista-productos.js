import { seleccionarProductos } from "../models/productos.js";

//objetos del DOM (el html)
const listado = document.querySelector('#listado');

//Variables y constantes generales
let productos = []; //array
let producto = {}; //objeto

/**
 * Metodo que se ejecuta cuando se carga la pagina
 */
document.addEventListener('DOMContentLoaded', () => {
    mostrarProductos();
})

/**
 * Metodo para mostrar los productos
 */
async function mostrarProductos(){
    productos = await seleccionarProductos();
    listado.innerHTML = '';

    productos.map(producto => {
        listado.innerHTML += `
        <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="./img/productos/${producto.imagen}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">${producto.codigo} - ${producto.nombre}</h5>
                          <p class="card-text">${producto.descripcion}</p>
                          <a href="#" class="btn btn-primary">Ver Más</a>
                    </div>
        </div>`
    })
}