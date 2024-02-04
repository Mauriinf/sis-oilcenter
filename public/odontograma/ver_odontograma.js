document.addEventListener('DOMContentLoaded', () => {
    let id_consulta= $('#id_consulta').val();
    const camada1 = document.querySelector('#camada1Odontograma')
    const contexto1 = camada1.getContext('2d')

    const camada2 = document.querySelector('#camada2Odontograma')
    const contexto2 = camada2.getContext('2d')

    const camada3 = document.querySelector('#camada3Odontograma')
    const contexto3 = camada3.getContext('2d')

    const camada4 = document.querySelector('#camada4Odontograma')
    const contexto4 = camada4.getContext('2d')


    const modal = new bootstrap.Modal(document.getElementById('modal'))

    let posicoesPadrao = {
        posicaoYInicialDente: 180,
        margemXEntreDentes: 8,
        margemYEntreDentes: 200
    }

    const tamanhoTelaReferencia = 1895
    const alturaTelaReferencia = 872

    const itensProcedimento = [{
        nome: 'Lesión de caries blanca activa',
        cor: '#008000'
    }, {
        nome: 'Lesión de caries blanca inactiva',
        cor: '#FFFF00'
    }, {
        nome: 'lesión de caries cavitada',
        cor: '#FF0000'
    }, {
        nome: 'Caries paralizada/pigmentación del surco',
        cor: '#000000'
    }, {
        nome: 'Restaurantes en buen estado',
        cor: '#0000FF'
    }, {
        nome: 'Restauración para cambiar',
        cor: '#FFC0CB'
    }, {
        nome: 'Lesión cervical no cariosa',
        cor: '#8B0000'
    }, {
        nome: 'Faceta de desgaste',
        cor: '#FA8072'
    }, {
        nome: 'sección clara',
        cor: '#FFFFFF'
    }, {
        nome: 'Otro',
        cor: '#008080'
    }]

    let procedimentos = []
    let lista=[];
    class Procedimento {
        constructor(nome, cor, numeroDente, faceDente, informacoesAdicionais) {
            this.nome = nome;
            this.cor = cor;
            this.numeroDente = numeroDente;
            this.faceDente = faceDente;
            this.informacoesAdicionais = informacoesAdicionais;
        }
        valido() {
            const campos = ['nome', 'cor', 'numeroDente', 'faceDente']
            if (this.nome === null || this.nome === undefined || this.nome === '') return false
            if (this.cor === null || this.cor === undefined || this.cor === '') return false
            if (this.numeroDente === null || this.numeroDente === undefined || this.numeroDente === '') return false
            if (this.faceDente === null || this.faceDente === undefined || this.faceDente === '') return false
            return true
        }
        criaObjeto() {
            return {
                nome: this.nome,
                cor: this.cor,
                numeroDente: this.numeroDente,
                faceDente: this.faceDente,
                informacoesAdicionais: this.informacoesAdicionais
            }
        }
        limpar() {
            this.nome = null;
            this.cor = null;
            this.numeroDente = null;
            this.faceDente = null;
            this.informacoesAdicionais = null;
        }
        salvar() {
            if (this.valido()) {
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/guardar/odontograma",
                    type: 'POST',
                    dataType : 'json',
                    data: { id_consulta:id_consulta,id_tratamiento:this.nome,numeroDiente:this.numeroDente,parteDiente:this.faceDente,obsevacion:this.informacoesAdicionais},
                    success: function(data)
                    {
                    },
                });
                procedimentos =recuperarDatos()
                 //const procedimento = procedimentos.find(prc => prc.nome === this.nome && prc.numeroDente === this.numeroDente && prc.faceDente === this.faceDente)
                 //if (procedimento === undefined) procedimentos.push(this.criaObjeto())
                 //else procedimentos[procedimentos.indexOf(procedimento)] = this.criaObjeto()
                // storage.save(procedimentos)
            }
        }
        remover() {
            procedimentos.splice(procedimentos.indexOf(this.criaObjeto()), 1)
            storage.save(procedimentos)
        }
    }

    let procedimento = new Procedimento()
    procedimento.indice = null

    const storage = {
        fetch() {
            return JSON.parse(localStorage.getItem('procedimentos') || '[]')
        },
        save(procedimentos) {
            localStorage.setItem('procedimentos', JSON.stringify(procedimentos))
            procedimentos = this.fetch()
            return procedimentos
        }
    };

    let tamanhoColuna = camada1.width / 16
    let tamanhoDente = tamanhoColuna - (2 * posicoesPadrao.margemXEntreDentes)

    let dimensionesTrapecio = {
        // Base maior será a altura e largura do dente
        // Base menor será 3/4 da base maior
        // Lateral será 1/4 da base maior

        baseMayor: tamanhoDente,
        lateral: tamanhoDente / 4,
        baseMenor: (tamanhoDente / 4) * 3
    }

    let numeroDientes = {
        superior: ['18', '17', '16', '15', '14', '13', '12', '11', '21', '22', '23', '24', '25', '26', '27', '28'],
        inferior: ['48', '47', '46', '45', '44', '43', '42', '41', '31', '32', '33', '34', '35', '36', '37', '38']
    }

    let numeroDenteXOrdemExibicaoDente = new Array()

    /**
     *Define la posición inicial del diente en el eje x a partir de su índice.
     *
     * @example
     *   definePosicionXInicialDiente(5)
     *
     * @param   {Number}    index      parámetro obligatorio
     * @returns {Number}
     */
    const definePosicionXInicialDiente = (index) => {
        if (index === 0) return (index * tamanhoDente) + (posicoesPadrao.margemXEntreDentes * index) + posicoesPadrao.margemXEntreDentes;
        else return (index * tamanhoDente) + (2 * posicoesPadrao.margemXEntreDentes * index) + posicoesPadrao.margemXEntreDentes;
    }

    /**
     * Dibuja los dientes con sus respectivas caras.
     *
     * @example
     *   dibujarDiente(20, 20)
     *
     * @param   {Number} posicionX      parámetro obligatorio
     * @param   {Number} posicionY      parámetro obligatorio
     */
    const dibujarDiente = (posicionX, posicionY) => {
        contexto1.fillStyle = 'black';
        contexto1.strokeStyle = 'black';

        /* 1º trapecio */
        contexto1.beginPath();
        contexto1.moveTo(posicionX, posicionY);
        contexto1.lineTo(dimensionesTrapecio.baseMayor + posicionX, posicionY);
        contexto1.lineTo(dimensionesTrapecio.baseMenor + posicionX, dimensionesTrapecio.lateral + posicionY);
        contexto1.lineTo(dimensionesTrapecio.lateral + posicionX, dimensionesTrapecio.lateral + posicionY);
        contexto1.closePath();
        contexto1.stroke();

        /* 2º trapecio */
        contexto1.beginPath();
        contexto1.moveTo(dimensionesTrapecio.baseMenor + posicionX, dimensionesTrapecio.lateral + posicionY);
        contexto1.lineTo(dimensionesTrapecio.baseMayor + posicionX, posicionY);
        contexto1.lineTo(dimensionesTrapecio.baseMayor + posicionX, dimensionesTrapecio.baseMayor + posicionY);
        contexto1.lineTo(dimensionesTrapecio.baseMenor + posicionX, dimensionesTrapecio.baseMenor + posicionY);
        contexto1.closePath();
        contexto1.stroke();

        /* 3º trapecio */
        contexto1.beginPath();
        contexto1.moveTo(dimensionesTrapecio.lateral + posicionX, dimensionesTrapecio.baseMenor + posicionY);
        contexto1.lineTo(dimensionesTrapecio.baseMenor + posicionX, dimensionesTrapecio.baseMenor + posicionY);
        contexto1.lineTo(dimensionesTrapecio.baseMayor + posicionX, dimensionesTrapecio.baseMayor + posicionY);
        contexto1.lineTo(posicionX, dimensionesTrapecio.baseMayor + posicionY);
        contexto1.closePath();
        contexto1.stroke();

        /* 4º trapecio */
        contexto1.beginPath();
        contexto1.moveTo(posicionX, posicionY);
        contexto1.lineTo(dimensionesTrapecio.lateral + posicionX, dimensionesTrapecio.lateral + posicionY);
        contexto1.lineTo(dimensionesTrapecio.lateral + posicionX, dimensionesTrapecio.baseMenor + posicionY);
        contexto1.lineTo(posicionX, dimensionesTrapecio.baseMayor + posicionY);
        contexto1.closePath();
        contexto1.stroke();
    }

    /**
     * Hace el efecto de 'flotar' cuando se pasa el mouse sobre una cara.
     *
     * @example
     *   marcarSecao(contexto, 2, 5)
     *
     * @param   {Object} contexto                parámetro obligatorio
     * @param   {Number} ordemExibicaoDente      parámetro obligatorio
     * @param   {Number} face                   parámetro obligatorio
     */
    const marcarSecao = (contexto, ordemExibicaoDente, face) => {
        contexto.lineWidth = 2
        let cor_linha = 'orange';
        let posicaoY = 0

        if (ordemExibicaoDente < 17) posicaoY = posicoesPadrao.posicaoYInicialDente;
        else {
            ordemExibicaoDente -= 16;
            posicaoY = dimensionesTrapecio.baseMayor + posicoesPadrao.margemYEntreDentes + posicoesPadrao.posicaoYInicialDente;
        }
        let posicaoX = definePosicionXInicialDiente(ordemExibicaoDente - 1)

        /* 1ª zona */
        if (face === 1) {
            if (contexto) {
                contexto.fillStyle = cor_linha;
                contexto.beginPath();
                contexto.moveTo(posicaoX, posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMayor + posicaoX, posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                contexto.lineTo(dimensionesTrapecio.lateral + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                contexto.closePath();
                contexto.strokeStyle = 'orange';
                contexto.stroke();
            }
        }
        /* 2ª zona */
        if (face === 2) {
            if (contexto) {
                contexto.fillStyle = cor_linha;
                contexto.beginPath();
                contexto.moveTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMayor + posicaoX, posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMayor + posicaoX, dimensionesTrapecio.baseMayor + posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                contexto.closePath();
                //contexto.fill();
                contexto.strokeStyle = 'orange';
                contexto.stroke();
            }
        }
        /* 3ª zona */
        if (face === 3) {
            if (contexto) {
                contexto.fillStyle = cor_linha;
                contexto.beginPath();
                contexto.moveTo(dimensionesTrapecio.lateral + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMayor + posicaoX, dimensionesTrapecio.baseMayor + posicaoY);
                contexto.lineTo(posicaoX, dimensionesTrapecio.baseMayor + posicaoY);
                contexto.closePath();
                contexto.strokeStyle = 'orange';
                contexto.stroke();
            }
        }
        /* 4ª zona */
        if (face === 4) {
            if (contexto) {
                contexto.fillStyle = cor_linha;
                contexto.beginPath();
                contexto.moveTo(posicaoX, posicaoY);
                contexto.lineTo(dimensionesTrapecio.lateral + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                contexto.lineTo(dimensionesTrapecio.lateral + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                contexto.lineTo(posicaoX, dimensionesTrapecio.baseMayor + posicaoY);
                contexto.closePath();
                contexto.strokeStyle = 'orange';
                contexto.stroke();
            }
        }
        /* 5ª zona(medio) */
        if (face === 5) {
            if (contexto) {
                contexto.fillStyle = cor_linha;
                contexto.beginPath();
                contexto.moveTo(dimensionesTrapecio.lateral + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                contexto.lineTo(dimensionesTrapecio.lateral + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                contexto.closePath();
                contexto.strokeStyle = 'orange';
                contexto.stroke();
            }
        }
    }
    function estaEnPantalla(elemento) {
        var estaEnPantalla = false;

        var posicionElemento = $(elemento).get(0).getBoundingClientRect();

        if (posicionElemento.top >= 0 && posicionElemento.left >= 0
                && posicionElemento.bottom <= (window.innerHeight || document.documentElement.clientHeight)
                && posicionElemento.right <= (window.innerWidth || document.documentElement.clientWidth)) {
            estaEnPantalla = true;
        }

        return estaEnPantalla;
    }
    camada4.onmousemove = (event) => {
        let x = event.x
        let y = event.y
        if(estaEnPantalla('#navegation')){
            x -= (camada1.offsetLeft+document.getElementById('navegation').clientWidth)
            y -= camada1.offsetTop
        }else{
            x -= camada1.offsetLeft //(x-document.getElementById('canva-group').clientWidth)  //+255
            y -= camada1.offsetTop
        }
        procedimento.limpar()
        procedimento.indice = null

        procedimento = getInfoDentePosicaoatual(procedimento, x, y)
        if (getOrdemExibicaoPorNumeroDente(procedimento.numeroDente) > 0) {
            if (procedimento.faceDente) {
                color = 'orange';
                contexto3.clearRect(0, 0, camada3.width, camada3.height)
                marcarSecao(contexto3, getOrdemExibicaoPorNumeroDente(procedimento.numeroDente), procedimento.faceDente);
            } else contexto3.clearRect(0, 0, camada3.width, camada3.height)
        } else contexto3.clearRect(0, 0, camada3.width, camada3.height)
    }

    camada4.touchstart = (event) => {
        alert('touch')
    }

    camada4.onclick = (event) => {
        let x = event.x
        let y = event.y
        if(estaEnPantalla('#navegation')){
            x -= (camada1.offsetLeft+document.getElementById('navegation').clientWidth)
            y -= camada1.offsetTop
        }else{
            x -= camada1.offsetLeft
            y -= camada1.offsetTop
        }

        procedimento.limpar()
        procedimento.indice = null

        procedimento = getInfoDentePosicaoatual(procedimento, x, y)

        if (procedimento.faceDente) modal.show()
        atualizaTabela()
    }

    const atualizaTabela = () => {
        const tbody = document.getElementById('bodyProcedimentos')
        let trs = ''
        let cont=0;
        procedimentos.filter(prc => prc.numeroDente === procedimento.numeroDente && prc.faceDente === procedimento.faceDente).forEach(item => {
            const tr = `
                <tr>
                    <td>
                        ${item.nome} (${item.costo_referencial} Bs.)
                    </td>
                    <td>
                        <input type="color" disabled class="form-control form-control-color" value="${item.cor}">
                    </td>
                    <td>
                        ${item.informacoesAdicionais || 'NO CONFIRMADO'}
                    </td>
                    <td>
                        <input id=\'dpago${item.id}\' type=\'number\' step=\'any\' min=\'0\' class=\'pagos form-control input-sm\' style=\'width:100%\' value=\'${item.pago}\'>
                        <input id=\'dpagoid${item.id}\' type=\'hidden\' step=\'any\' class=\'idsPagos\' value=\'${item.id}\'>
                    </td>

                </tr>
            `
            trs += tr
        })
        tbody.innerHTML = trs
    }

    window.apagar = (id,nome, numeroDente, faceDente) => {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/eliminar/odontograma",
            type: 'POST',
            dataType : 'json',
            data: { id:id},
            success: function(data)
            {
            },
        });
        procedimentos =recuperarDatos()
        //const procd = procedimentos.find(prc => prc.nome === nome && prc.numeroDente === numeroDente && prc.faceDente === faceDente)
        //procedimentos.splice(procedimentos.indexOf(procd), 1)
        //storage.save(procedimentos)
        atualizaTabela()
        resizeCanvas()
    }

    /**
     * Muestra el 'esqueleto' del odontograma (los dientes y su numeración).
     */
    const VisualizarEstructura = () => {
        // document.querySelector("#canva-group").style.display = 'block'
        for (let index = 0; index < 16; index++) {
            const posicaoX = definePosicionXInicialDiente(index)
            dibujarDiente(posicaoX, posicoesPadrao.posicaoYInicialDente)
        }
        for (let index = 0; index < 16; index++) {
            const posicaoX = definePosicionXInicialDiente(index)
            dibujarDiente(posicaoX, posicoesPadrao.margemYEntreDentes + tamanhoDente + posicoesPadrao.posicaoYInicialDente)
        }
        numeroDientes.superior.forEach((numero, index) => {
            const posicaoX = definePosicaoXInicialQuadrado(index)
            dibujarCuadradoNumDiente({
                posicion: {
                    x: posicaoX,
                    y: (posicoesPadrao.margemYEntreDentes / 5) + tamanhoDente + posicoesPadrao.posicaoYInicialDente
                },
                primerOUltimoDiente: index === 0 || index === 15,
                numeroDente: numero,
                altura: tamanhoDente / 1.8,
                ancho: index === 0 || index === 15 ? tamanhoDente + posicoesPadrao.margemXEntreDentes : tamanhoDente + 2 * posicoesPadrao.margemXEntreDentes
            })
        })

        numeroDientes.inferior.forEach((numero, index) => {
            const posicaoX = definePosicaoXInicialQuadrado(index)
            dibujarCuadradoNumDiente({
                posicion: {
                    x: posicaoX,
                    y: (posicoesPadrao.margemYEntreDentes / 5) + (tamanhoDente / 1.8) + tamanhoDente + posicoesPadrao.posicaoYInicialDente
                },
                primerOUltimoDiente: index === 0 || index === 15,
                numeroDente: numero,
                altura: tamanhoDente / 1.8,
                ancho: index === 0 || index === 15 ? tamanhoDente + posicoesPadrao.margemXEntreDentes : tamanhoDente + 2 * posicoesPadrao.margemXEntreDentes
            })
        })
    }

    /**
     * Define a posição inicial do quadrado no eixo x a partir de seu índice.
     *
     * @param {Number} index
     */
    const definePosicaoXInicialQuadrado = (index) => {
        if (index === 0) return (index * tamanhoDente) + posicoesPadrao.margemXEntreDentes;
        else return (index * tamanhoDente) + (2 * index * posicoesPadrao.margemXEntreDentes);
    }

    /**
     * Dibujar el cuadrado que informa el número de diente.
     *
     * @example
     *   dibujarCuadradoNumDiente(cuadrado)
     *
     * @param   {Object} quadrado   parámetro obligatorio
     */
    const dibujarCuadradoNumDiente = (cuadrado) => {
        let tamanhoFonte = (40 * (cuadrado.primerOUltimoDiente ? cuadrado.ancho + posicoesPadrao.margemXEntreDentes : cuadrado.ancho)) / 118.4375
        contexto1.font = `${tamanhoFonte}px arial`
        contexto1.strokeRect(cuadrado.posicion.x, cuadrado.posicion.y, cuadrado.ancho, cuadrado.altura)
        contexto1.fillText(cuadrado.numeroDente, cuadrado.posicion.x + tamanhoDente / 2.8, cuadrado.posicion.y + (tamanhoDente / 2.5));
    }

    /**
     * Pinta a face do dente de acordo com o procedimento adicionado.
     *
     * @example
     *   pintarFace(contexto, procedimento, 'black', 'orange')
     *
     * @param   {Object} contexto                Parâmetro obrigatório
     * @param   {Object} procedimento   Parâmetro obrigatório
     * @param   {String} cor_linha               Parâmetro obrigatório
     * @param   {String} cor_interior            Parâmetro obrigatório
     */
    const pintarFace = (contexto, procedimento, cor_linha, cor_interior) => {
        let numeroDente = getOrdemExibicaoPorNumeroDente(procedimento.numeroDente) - 1
        contexto.fillStyle = cor_interior
        contexto.strokeStyle = cor_linha

        let posicaoY = 0

        if (numeroDente < 16) posicaoY = posicoesPadrao.posicaoYInicialDente;
        else {
            numeroDente -= 16;
            posicaoY = dimensionesTrapecio.baseMayor + posicoesPadrao.margemYEntreDentes + posicoesPadrao.posicaoYInicialDente;
        }

        const prcdms = getProcedimentosPorDente(procedimento.numeroDente, procedimento.faceDente)
        const numeroDivisoes = prcdms.length - 1
        let dividir = false
        if (numeroDivisoes > 0) dividir = true

        let posicaoX = definePosicionXInicialDiente(numeroDente)

        /* 1ª zona */
        if (procedimento.faceDente === 1 && !dividir) {
            if (contexto) {
                contexto.beginPath();
                contexto.moveTo(posicaoX, posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMayor + posicaoX, posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                contexto.lineTo(dimensionesTrapecio.lateral + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                contexto.closePath();
                contexto.fill();
                contexto.stroke();
            }
        } else if (procedimento.faceDente === 1 && dividir) {
            if (contexto) {
                const larguraDivisao = dimensionesTrapecio.baseMayor / (numeroDivisoes + 1)
                prcdms.forEach((procedimentoItem, divisao) => {
                    contexto.fillStyle = procedimentoItem.cor
                    const ultimo = divisao === numeroDivisoes
                    const primeiro = divisao === 0
                    const dentroAreaTriangular = larguraDivisao * (divisao + 1) < dimensionesTrapecio.lateral
                    contexto.beginPath();
                    contexto.moveTo((larguraDivisao * divisao) + posicaoX, posicaoY);
                    contexto.lineTo(larguraDivisao * (divisao + 1) + posicaoX, posicaoY);
                    if (ultimo) {
                        contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                        contexto.lineTo((larguraDivisao * divisao) + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                    } else if (!primeiro) {
                        contexto.lineTo(larguraDivisao * (divisao + 1) + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                        contexto.lineTo((larguraDivisao * divisao) + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                    } else {
                        contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                        contexto.lineTo(dimensionesTrapecio.lateral + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                    }
                    contexto.closePath();
                    contexto.fill();
                    contexto.stroke();
                })
            }
        }


        /* 2ª zona */
        if (procedimento.faceDente === 2 && !dividir) {
            if (contexto) {
                contexto.beginPath();
                contexto.moveTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMayor + posicaoX, posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMayor + posicaoX, dimensionesTrapecio.baseMayor + posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                contexto.closePath();
                contexto.fill();
                contexto.stroke();
            }
        } else if (procedimento.faceDente === 2 && dividir) {
            if (contexto) {
                const larguraDivisao = dimensionesTrapecio.baseMayor / (numeroDivisoes + 1)
                prcdms.forEach((procedimentoItem, divisao) => {
                    contexto.fillStyle = procedimentoItem.cor
                    const ultimo = divisao === numeroDivisoes
                    const primeiro = divisao === 0
                    contexto.beginPath();
                    contexto.moveTo(dimensionesTrapecio.baseMayor + posicaoX, (larguraDivisao * divisao) + posicaoY);
                    contexto.lineTo(dimensionesTrapecio.baseMayor + posicaoX, dimensionesTrapecio.baseMayor + posicaoY);
                    if (ultimo) {
                        contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                        contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, (larguraDivisao * divisao) + posicaoY);
                    } else if (!primeiro) {
                        contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                        contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, (larguraDivisao * divisao) + posicaoY);
                    } else {
                        contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                        contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                    }
                    contexto.closePath();
                    contexto.fill();
                    contexto.stroke();
                })
            }
        }

        /* 3ª zona */
        if (procedimento.faceDente === 3 && !dividir) {
            if (contexto) {
                contexto.beginPath();
                contexto.moveTo(dimensionesTrapecio.lateral + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMayor + posicaoX, dimensionesTrapecio.baseMayor + posicaoY);
                contexto.lineTo(posicaoX, dimensionesTrapecio.baseMayor + posicaoY);
                contexto.closePath();
                contexto.fill();
                contexto.stroke();
            }
        } else if (procedimento.faceDente === 3 && dividir) {
            if (contexto) {
                const larguraDivisao = dimensionesTrapecio.baseMayor / (numeroDivisoes + 1)
                prcdms.forEach((procedimentoItem, divisao) => {
                    contexto.fillStyle = procedimentoItem.cor
                    const ultimo = divisao === numeroDivisoes
                    const primeiro = divisao === 0
                    const dentroAreaTriangular = larguraDivisao * (divisao + 1) < dimensionesTrapecio.lateral
                    contexto.beginPath();
                    contexto.moveTo((larguraDivisao * divisao) + posicaoX, posicaoY + tamanhoDente);
                    contexto.lineTo(larguraDivisao * (divisao + 1) + posicaoX, posicaoY + tamanhoDente);
                    if (ultimo) {
                        contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                        contexto.lineTo((larguraDivisao * divisao) + posicaoX, dimensionesTrapecio.lateral + posicaoY + dimensionesTrapecio.baseMenor);
                    } else if (!primeiro) {
                        contexto.lineTo(larguraDivisao * (divisao + 1) + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                        contexto.lineTo((larguraDivisao * divisao) + posicaoX, posicaoY + dimensionesTrapecio.baseMenor);
                    } else {
                        contexto.lineTo((larguraDivisao * (divisao + 1)) + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                        contexto.lineTo(posicaoX, dimensionesTrapecio.lateral + posicaoY + dimensionesTrapecio.baseMenor);
                    }
                    contexto.closePath();
                    contexto.fill();
                    contexto.stroke();
                })
            }
        }

        /* 4ª zona */
        if (procedimento.faceDente === 4 && !dividir) {
            if (contexto) {
                contexto.beginPath();
                contexto.moveTo(posicaoX, posicaoY);
                contexto.lineTo(dimensionesTrapecio.lateral + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                contexto.lineTo(dimensionesTrapecio.lateral + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                contexto.lineTo(posicaoX, dimensionesTrapecio.baseMayor + posicaoY);
                contexto.closePath();
                contexto.fill();
                contexto.stroke();
            }
        } else if (procedimento.faceDente === 4 && dividir) {
            if (contexto) {
                const larguraDivisao = dimensionesTrapecio.baseMayor / (numeroDivisoes + 1)
                prcdms.forEach((procedimentoItem, divisao) => {
                    contexto.fillStyle = procedimentoItem.cor
                    const ultimo = divisao === numeroDivisoes
                    const primeiro = divisao === 0
                    contexto.beginPath();
                    contexto.moveTo(posicaoX, (larguraDivisao * divisao) + posicaoY);
                    contexto.lineTo(posicaoX, larguraDivisao * (divisao + 1) + posicaoY);
                    if (ultimo) {
                        contexto.lineTo(posicaoX + dimensionesTrapecio.lateral, dimensionesTrapecio.baseMenor + posicaoY);
                        contexto.lineTo(posicaoX + dimensionesTrapecio.lateral, (larguraDivisao * divisao) + posicaoY);
                    } else if (!primeiro) {
                        contexto.lineTo(posicaoX + dimensionesTrapecio.lateral, dimensionesTrapecio.baseMenor + posicaoY);
                        contexto.lineTo(posicaoX + dimensionesTrapecio.lateral, (larguraDivisao * divisao) + posicaoY);
                    } else {
                        contexto.lineTo(posicaoX + dimensionesTrapecio.lateral, larguraDivisao * (divisao + 1) + posicaoY);
                        contexto.lineTo(posicaoX + dimensionesTrapecio.lateral, dimensionesTrapecio.lateral + posicaoY);
                    }
                    contexto.closePath();
                    contexto.fill();
                    contexto.stroke();
                })
            }
        }

        /* 5ª zona(medio) */
        if (procedimento.faceDente === 5 && !dividir) {
            if (contexto) {
                contexto.beginPath();
                contexto.moveTo(dimensionesTrapecio.lateral + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                contexto.lineTo(dimensionesTrapecio.baseMenor + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                contexto.lineTo(dimensionesTrapecio.lateral + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                contexto.closePath();
                contexto.fill();
                contexto.stroke();
            }
        } else if (procedimento.faceDente === 5 && dividir) {
            if (contexto) {
                const larguraDivisao = (dimensionesTrapecio.baseMenor - dimensionesTrapecio.lateral) / (numeroDivisoes + 1)
                prcdms.forEach((procedimentoItem, divisao) => {
                    contexto.fillStyle = procedimentoItem.cor
                    contexto.beginPath();
                    contexto.moveTo(dimensionesTrapecio.lateral + (divisao * larguraDivisao) + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                    contexto.lineTo(dimensionesTrapecio.lateral + ((divisao + 1) * larguraDivisao) + posicaoX, dimensionesTrapecio.lateral + posicaoY);
                    contexto.lineTo(dimensionesTrapecio.lateral + ((divisao + 1) * larguraDivisao) + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                    contexto.lineTo(dimensionesTrapecio.lateral + (divisao * larguraDivisao) + posicaoX, dimensionesTrapecio.baseMenor + posicaoY);
                    contexto.closePath();
                    contexto.fill();
                    contexto.stroke();
                })
            }
        }
    }

    /**
     * Cambia el tamaño del lienzo del odontograma y su contenido proporcionalmente al tamaño de la ventana.
     */
    const resizeCanvas = () => {
        if (window.innerWidth >= 500) {
            document.querySelector("#canva-group").style.display = 'display'
        } else {
            alert("¡PANTALLA MUY PEQUEÑA! Accede a la ficha dental a través de un dispositivo con una pantalla más grande")
            document.querySelector("#canva-group").style.display = 'none'
        }
        //window.innerWidth - 25
        camada1.width = camada2.width = camada3.width = camada4.width = document.getElementById('canva-group').clientWidth - 25
        const altura = (camada1.width * alturaTelaReferencia) / tamanhoTelaReferencia;//altura
        camada1.height =camada2.height =camada3.height=camada4.height = altura;

        valoresBase = {
            x: (camada1.width * 24) / tamanhoTelaReferencia,
            y: (camada1.width * 20) / tamanhoTelaReferencia,
            largura: (camada1.width * 70) / tamanhoTelaReferencia,
            altura: (camada1.width * 150) / tamanhoTelaReferencia
        }
        posicoesPadrao.margemXEntreDentes = (camada1.width * 8) / tamanhoTelaReferencia
        posicoesPadrao.margemYEntreDentes = (camada1.width * 200) / tamanhoTelaReferencia

        posicoesPadrao.posicaoYInicialDente = (camada1.width * 50) / tamanhoTelaReferencia;//altura margen inicial

        tamanhoColuna = camada1.width / 16
        tamanhoDente = tamanhoColuna - (2 * posicoesPadrao.margemXEntreDentes)

        dimensionesTrapecio = {
            baseMayor: tamanhoDente,
            lateral: tamanhoDente / 4,
            baseMenor: (tamanhoDente / 4) * 3
        }

        VisualizarMarcados()
        VisualizarEstructura()
    }

    /**
     * Devuelve los datos de los dientes en relación con la posición del mouse en la pantalla
     *
     * @example
     *   getInfoDentePosicaoatual(infoDentePosicaoAtual, 300, 255)
     *
     * @param   {Object} infoDentePosicaoAtual   parámetro obligatorio
     * @param   {Number} x                       parámetro obligatorio
     * @param   {Number} y                       parámetro obligatorio
     * @returns {Object}
     */
    const getInfoDentePosicaoatual = (procedimento, x, y) => {
        if (y >= posicoesPadrao.posicaoYInicialDente && y <= posicoesPadrao.posicaoYInicialDente + tamanhoDente) {
            if (x >= posicoesPadrao.margemXEntreDentes && x <= posicoesPadrao.margemXEntreDentes + tamanhoDente) procedimento.numeroDente = getNumeroDentePorOrdemExibicao(1);
            else if (x >= (tamanhoDente + posicoesPadrao.margemXEntreDentes * 3) && x <= (30 * posicoesPadrao.margemXEntreDentes + 16 * tamanhoDente)) {
                procedimento.indice = parseInt(x / (tamanhoDente + 2 * posicoesPadrao.margemXEntreDentes), 10);
                ini = (procedimento.indice * tamanhoDente) + (2 * posicoesPadrao.margemXEntreDentes * procedimento.indice) + posicoesPadrao.margemXEntreDentes;
                fin = ini + tamanhoDente;
                if (x >= ini && x <= fin) {
                    procedimento.numeroDente = getNumeroDentePorOrdemExibicao(procedimento.indice + 1)
                }
            }
        } else if (y >= (tamanhoDente + posicoesPadrao.margemYEntreDentes + posicoesPadrao.posicaoYInicialDente) && y <= (2 * tamanhoDente + posicoesPadrao.margemYEntreDentes + posicoesPadrao.posicaoYInicialDente)) {
            if (x >= posicoesPadrao.margemXEntreDentes && x <= posicoesPadrao.margemXEntreDentes + tamanhoDente) {
                procedimento.numeroDente = getNumeroDentePorOrdemExibicao(17);
            } else if (x >= (tamanhoDente + posicoesPadrao.margemXEntreDentes * 3) && x <= (30 * posicoesPadrao.margemXEntreDentes + 16 * tamanhoDente)) {
                procedimento.indice = parseInt(x / (tamanhoDente + 2 * posicoesPadrao.margemXEntreDentes), 10);
                ini = (procedimento.indice * tamanhoDente) + (2 * posicoesPadrao.margemXEntreDentes * procedimento.indice) + posicoesPadrao.margemXEntreDentes;
                fin = ini + tamanhoDente;
                if (x >= ini && x <= fin) procedimento.numeroDente = getNumeroDentePorOrdemExibicao(procedimento.indice + 17)
            }
        }

        let px = x - ((procedimento.indice * tamanhoDente) + (2 * posicoesPadrao.margemXEntreDentes * procedimento.indice) + posicoesPadrao.margemXEntreDentes)
        let py = y - posicoesPadrao.posicaoYInicialDente

        if (getOrdemExibicaoPorNumeroDente(procedimento.numeroDente) > 16) py -= (posicoesPadrao.margemYEntreDentes + tamanhoDente)

        if (py > 0 && py < (tamanhoDente / 4) && px > py && py < tamanhoDente - px) {
            procedimento.faceDente = 1;
        } else if (px > (tamanhoDente / 4) * 3 && px < tamanhoDente && py < px && tamanhoDente - px < py) {
            procedimento.faceDente = 2;
        } else if (py > (tamanhoDente / 4) * 3 && py < tamanhoDente && px < py && px > tamanhoDente - py) {
            procedimento.faceDente = 3;
        } else if (px > 0 && px < (tamanhoDente / 4) && py > px && px < tamanhoDente - py) {
            procedimento.faceDente = 4;
        } else if (px > (tamanhoDente / 4) && px < (tamanhoDente / 4) * 3 && py > (tamanhoDente / 4) && py < (tamanhoDente / 4) * 3) {
            procedimento.faceDente = 5;
        }

        return procedimento
    }

    /**
     * Muestra todos los procedimientos agregados en los respectivos dientes y caras
     */
    const VisualizarMarcados = () => {
        procedimentos.forEach(element => {
            pintarFace(contexto2, element, 'black', element.cor)
        });
    }
    //Recuperar datos desde la base de datos
    const recuperarDatos=()=>{

        lista=[];
        jQuery.ajax({
            url: "/lista/odontograma",
            type: 'GET',
            dataType : 'json',
            cache: 'true',
            data: { id_consulta:id_consulta},
            success: function(data)
            {
                for(var n = 0; n<data.length; n++){
                    let obj={};
                    obj ['id']=data[n].id;
                    obj ['id_consulta']=data[n].id_consulta;
                    obj ['id_tratamiento']=data[n].id_tratamiento;
                    obj ['costo_referencial']=data[n].costo;
                    obj ['nome']=data[n].descripcion;
                    obj ['cor']=data[n].color;
                    obj ['numeroDente']=data[n].id_diente;
                    obj ['faceDente']=data[n].parte_diente;
                    obj ['informacoesAdicionais']=data[n].observacion;
                    obj ['pago']=data[n].pago;
                    lista.push(obj);
                }
            },
            async: false // <- esto lo convierte en síncrono
        });
        return lista;
    }

    /**
     * Iniciar el odontograma, dibujar la estructura, cargar los datos, etc.
     */
    const iniciaOdontograma = () => {
        procedimentos =recuperarDatos()
        //procedimentos = storage.fetch()
        numeroDientes.superior.forEach((numero, index) => numeroDenteXOrdemExibicaoDente[numero] = index)
        numeroDientes.inferior.forEach((numero, index) => numeroDenteXOrdemExibicaoDente[numero] = index + 16)
        resizeCanvas()

    }

    /**
     * Retorna a ordem de exibição do dente a partir de seu número.
     *
     * @example
     *   getOrdemExibicaoPorNumeroDente(17); // 2
     *
     * @param   {Number} numero   Parâmetro obrigatório
     * @returns {Number}
     */
    const getOrdemExibicaoPorNumeroDente = (numero) => {
        return numeroDenteXOrdemExibicaoDente[numero] + 1
    }

    /**
     * Retorna o número do dente a partir de sua ordem de exibição.
     *
     * @example
     *   getNumeroDentePorOrdemExibicao(2); // 17
     *
     * @param   {Number} ordem   Parâmetro obrigatório
     * @returns {Number}
     */
    const getNumeroDentePorOrdemExibicao = (ordem) => {
        return numeroDenteXOrdemExibicaoDente.indexOf(ordem - 1)
    }

    /**
     * Retorna Todos os procedimentos adicionados para o dente informado.
     *
     * @example
     *   getProcedimentosPorDente(17); // [{...}]
     *
     * @param   {Number} numero   Parâmetro obrigatório
     * @returns {Array}
     */
    const getProcedimentosPorDente = (numero, face) => {
        return procedimentos.filter(procedimento => procedimento.numeroDente === numero && procedimento.faceDente === face)
    }

    window.addEventListener("resize", () => {
        resizeCanvas()

    })

    iniciaOdontograma()
})
