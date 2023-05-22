	<footer class="main-footer">
        <div class="text-center hidden-xs">
          <p><i class="fa fa-copyright" aria-hidden="true"> 2022 made by - <b>Holy Child Academy Binalonan Inc.</b></i></p>
        </div>
  </footer>
    <div class="notifications">
        
    </div>

  <script>
    window.start_load = function(){
      $('body').prepend('<div id="preloader2"></div>')
    }
    window.end_load = function(){
      $('#preloader2').fadeOut('fast', function() {
          $(this).remove();
        })
    }

    let notifications = document.querySelector('.notifications');

function createToast(type, title){
    let newToast = document.createElement('div');
    newToast.innerHTML = `
        <div class="toast ${type}">
                <div class="content">
                    <div class="title">${title}</div>
                </div>
            </div>`;

    notifications.appendChild(newToast);
    newToast.timeOut = setTimeout(() => newToast.remove(), 3000)
}
  </script>