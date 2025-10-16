
(function(){
  const nav = document.getElementById('site-nav');
  if(!nav) return;

  // mobile toggle (hamburger) — keep as before
  let btn = nav.querySelector('.mobile-toggle');
  if(!btn){
    btn = document.createElement('button');
    btn.className = 'mobile-toggle';
    btn.setAttribute('aria-expanded','false');
    btn.innerHTML = '☰';
    nav.insertBefore(btn, nav.firstChild);
  }

  btn.addEventListener('click', ()=> {
    const opened = nav.classList.toggle('open');
    btn.setAttribute('aria-expanded', opened ? 'true' : 'false');
  });

  // helper to add a child-toggle button to a parent li
  function addChildToggle(parent){
    if (parent.querySelector('.child-toggle')) return; // don't duplicate
    const t = document.createElement('button');
    t.type = 'button';
    t.className = 'child-toggle';
    t.setAttribute('aria-expanded','false');
    t.textContent = '▾';
    t.style.border = '0';
    t.style.background = 'transparent';
    t.style.cursor = 'pointer';
    t.style.marginLeft = '6px';
    // insert after the anchor
    const a = parent.querySelector('a');
    if (a) a.after(t);
    t.addEventListener('click', (e)=>{
      e.preventDefault();
      e.stopPropagation();
      const isOpen = parent.classList.toggle('open-child');
      t.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    // Also prevent first tap from navigating on mobile (optional behaviour)
    if (a) {
      a.addEventListener('click', function(e){
        if (window.innerWidth <= 900 && !parent.classList.contains('open-child')) {
          e.preventDefault();
          parent.classList.add('open-child');
          t.setAttribute('aria-expanded', 'true');
        }
      });
    }
  }

  // helper to remove child-toggle if exists
  function removeChildToggle(parent){
    const t = parent.querySelector('.child-toggle');
    if(t) t.remove();
    parent.classList.remove('open-child');
  }

  // manage toggles based on current viewport
  function updateToggles() {
    const parents = Array.from(nav.querySelectorAll('li.menu-item-has-children'));
    if (window.innerWidth <= 900) {
      parents.forEach(addChildToggle);
    } else {
      parents.forEach(removeChildToggle);
    }
  }

  // initial run
  updateToggles();

  // update on resize (debounced)
  let rezTimer;
  window.addEventListener('resize', function(){
    clearTimeout(rezTimer);
    rezTimer = setTimeout(updateToggles, 150);
  });

})();




