<div class="row message-content-list" id="message-content-area-<?php echo $data['id'] ?>">
    <div class="col-md-12">
        <div class="media">
            <div class="media-body tar">
                <small>
                    <?php echo $this->userNickname($data['account'], $data['nickname'], $data['introduce'], false, array(
                        'class' => 'ia',
                        'target' => '_parent'
                    )) ?>
                </small>
                <div class="message-content" style="margin-left:45%">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="left:8px">
                        <span aria-hidden="true" class="message-del-flag" message-id="<?php echo $data['id'] ?>">&times;</span>
                    </button>
                    <?php echo $data['content'] ?>
                </div>
            </div>
            <div class="media-right">
                <a href="<?php echo $this->url('user:detail', array('account' => $data['account'])) ?>" target="_parent">
                    <?php echo $this->userAvatar($data['avatar'], '24px') ?>
                </a>
            </div>
        </div>
    </div>
</div>

<?php
/**
 * @Auth: cmz <393418737@qq.com>
 * right.tpl.php
 */

