        </div>
    </div>

</section>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jquery-1.8.3.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){
                var sidebarNav = $(".nav-collapse");
                var wrapper = $(".content-wrapper");

                $(".sidebar-toggle-btn").on('click', function(){
                    sidebarNav.toggleClass('collapsed');
                    wrapper.toggleClass('wide');
                })

            })
        </script>

</body>
</html>
