<div id="nav">
    <div class="boxnav">
        <h3 class="titlenav">Entry Sebelumnya</h3>
        <?php if (isset($terdaftar_terakhir)) { ?> 
        <div id="last_entry">
            <table width="175" border="0" cellspacing="5" cellpadding="0">
<!--                    <tr>
                    <td class="style2">Nomor Kontrol : <span id="last_nomor">NOMOR</span></td>
                </tr>-->
                <tr>
                    <td class="style2">Nama : <span id="last_nama"><?php echo $terdaftar_terakhir['NAMA']; ?></span></td>
                </tr>
                <tr>
                    <td class="style2">
                        No Ujian : <span id="last_no_ujian"><?php echo $terdaftar_terakhir['NO_UJIAN']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="style2">Pilihan 1 : <span id="last_pilih1"><?php echo $terdaftar_terakhir['PILIH1']; ?></span></td>
                </tr>
                <tr>
                    <td class="style2">Pilihan 2 : <span id="last_pilih2"><?php echo (isset($terdaftar_terakhir['PILIH2'])) ? $terdaftar_terakhir['PILIH2'] : ''; ?></span></td>
                </tr>
            </table>
        </div>
        <?php } else { ?> 
        <div id="no_last">
            <p>Tidak Ada Input Sebelumnya . . .</p>
        </div>
        <?php } ?> 
        <br/>
        <div class="clear"></div>
    </div>
</div>
