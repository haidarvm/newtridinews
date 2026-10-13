    <!-- Modal -->
    <div class="modal " id="haidarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gallery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="search_form" onsubmit="return false">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="gallery-search" />
                                </div>
                                <div class="col-sm-2">
                                    <input type="submit" id="search" class="btn btn-info" value="search">
                                </div>
                            </div>
                        </form>
                        <div id="gallery"></div>
                        <div id="gallery-first">
                            <?php foreach ($gallery as $row) {
                                echo $row->img_thumb; ?>
                            <a href="javascript:void(0)" class="img-click"
                                onclick=imageCheck(<?=$row->image_featured_id . ',"' . $row->img_thumb . '"'?>)><img
                                    class="lazy gallery-item"
                                    data-src="<?php echo imgBasePathUrl($row->img_thumb); ?>" /></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>

                </div>
            </div>
        </div>