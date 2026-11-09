import $ from 'jquery'; window.$ = window.jQuery = $;
import * as bootstrap from 'bootstrap'; window.bootstrap = bootstrap;
const T = n => bootstrap.Modal.getOrCreateInstance(document.getElementById(n));
$(() => {
  $('[data-show]').each(function(){ bootstrap.Modal.getOrCreateInstance(this).show(); });
  if (!$('#sb').length) return;                       // solo en /arma-tu-pizza
  const C = window.PZ, LV = ['Poco','Normal','Extra'], STEPS = ['Estilo','Tamaño','Masa','Queso','Ingredientes','Resumen'];
  const d = C.edit ? {...C.edit, index: C.editIndex} : {size:'Mediana',masa:'Tradicional',queso:'Mozzarella',ings:[]};
  let step = C.edit ? 5 : 0, adding = [];
  const own = n => (C.pizzas[d.style]?.ings || []).includes(n);
  const price = () => { if(!d.style) return 0; const s=C.pizzas[d.style];
    let t=s.price+C.sizes[d.size]+C.masas[d.masa]+C.quesos[d.queso];
    d.ings.forEach(g=>{const c=C.ingredients[g.n],x=g.l==2; t+= own(g.n)?(x?c:0):(x?2*c:c)}); return t; };   // misma regla que el servidor
  const sg = v => v ? (v>0?'+':'-')+'$'+Math.abs(v) : 'Incluido';
  const list = (k, o) => Object.entries(o).map(([n,v])=>`<button class="opt ${d[k]==n?'on':''}" data-k="${k}" data-v="${n}"><span>${n}</span><span>${sg(v)}</span></button>`).join('');
  function render(){
    $('#st').text(`Paso ${step+1} de 6`); $('#pg').css('width',(step+1)/6*100+'%'); $('#sh').text(STEPS[step]);
    let h='';
    if(step==0) h=Object.entries(C.pizzas).map(([k,p])=>`<button class="opt ${d.style==k?'on':''}" data-k="style" data-v="${k}"><span><b>${p.name}</b><br><small>${p.desc}</small></span><span class="price">$${p.price}</span></button>`).join('');
    if(step==1) h=list('size',C.sizes); if(step==2) h=list('masa',C.masas); if(step==3) h=list('queso',C.quesos);
    if(step==4){ d.ings.sort((a,b)=>a.n.localeCompare(b.n,'es'));
      h=d.ings.map((g,i)=>`<div class="ing"><b>${g.n}</b><button class="btn btn-light btn-sm lv-b" data-i="${i}" data-d="-1" ${g.l==0?'disabled':''}>‹</button><span class="lv">${LV[g.l]}</span><button class="btn btn-light btn-sm lv-b" data-i="${i}" data-d="1" ${g.l==2?'disabled':''}>›</button><button class="btn btn-outline-primary btn-sm del" data-i="${i}">✕</button></div>`).join('')+'<button class="btn btn-outline-primary" id="addI">Agregar ingrediente</button>'; }
    if(step==5) h=`<div class="card card-body"><b>${d.style?C.pizzas[d.style].name:''}</b><span class="text-muted small">${d.size} · ${d.masa} · ${d.queso}<br>${d.ings.map(g=>g.n+' ('+LV[g.l]+')').join(', ')||'Sin ingredientes'}</span></div>`;
    $('#sb').html(h); $('#bk').prop('disabled',step==0); $('#nx').prop('disabled',!d.style).text(step==5?(C.edit?'Guardar':'Agregar al carrito'):'Siguiente');
    $('#ts').text(d.style?C.pizzas[d.style].name:'Elige un estilo'); $('#tp').text('$'+price());
  }
  $('#sb').on('click','.opt',function(){ const k=$(this).data('k'),v=String($(this).data('v')); d[k]=v;
    if(k=='style') d.ings=C.pizzas[v].ings.map(n=>({n,l:1}));
    render(); if(step<4) setTimeout(()=>{step++;render()},180); });
  $('#sb').on('click','.lv-b',function(){ d.ings[$(this).data('i')].l+=+$(this).data('d'); render(); })
          .on('click','.del',function(){ d.ings.splice($(this).data('i'),1); render(); })
          .on('click','#addI',()=>{ const have=d.ings.map(g=>g.n); adding=Object.keys(C.ingredients).filter(n=>!have.includes(n)); $('#q').val(''); fl(); T('mIng').show(); });
  const fl = () => { const q=$('#q').val().toLowerCase();
    $('#il').html(adding.filter(n=>n.toLowerCase().includes(q)).map(n=>`<label class="d-flex gap-2 py-2 border-bottom"><input type="checkbox" class="form-check-input" value="${n}"> ${n}<span class="price ms-auto small">$${C.ingredients[n]}</span></label>`).join('')); $('#ab').text('Agregar (0)'); };
  $('#q').on('input',fl); $('#il').on('change','input',()=>$('#ab').text(`Agregar (${$('#il input:checked').length})`));
  $('#ab').on('click',()=>{ $('#il input:checked').each(function(){ d.ings.push({n:this.value,l:1}); }); T('mIng').hide(); render(); });
  $('#bk').on('click',()=>{ step--; render(); });
  $('#nx').on('click',()=>{ if(step<5){ step++; return render(); }
    $.ajax({url:window.PZ_URL,method:'POST',contentType:'application/json',headers:{'X-CSRF-TOKEN':$('meta[name=csrf-token]').attr('content')},data:JSON.stringify(d)})
     .done(r=>{ $('#cart-count').text(r.count); C.edit ? location.href='/carrito' : T('mAsk').show(); }); });
  render();
});
