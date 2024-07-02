<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');
include_once('componentes/permissao.php');
?>
<style>
    li {
        font-size: 14px;
    }

    li strong {
        font-size: 13;
    }

    @media (max-width: 1600px) {
        .conteudo {
            margin-left: 75px;
            width: 95%;
        }

        .conteudo_menu {
            width: 70px;
        }

        .menu-principal {
            position: fixed;
            top: 0;
            left: -187px;
            z-index: 999999 !important;
            transition: all .5s ease;
        }


        .menu-logout {
            z-index: 1000000 !important;
        }

        .aparecer {
            left: 70px !important;
        }


        .menu-button {
            display: block;
            cursor: pointer;
        }
    }
</style>

<body>
    <?php
    include_once('menu.php');
    include_once('./conexoes/config.php');

    $item = $_GET['inputText'];
    
    $buscar_produtos = "SELECT COUNT(tipo) AS resultadosItem FROM item WHERE tipo='$item' AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $totalItem = $row_pg['resultadosItem'];

    $buscar_produtos = "SELECT COUNT(idbem) AS ascom FROM item WHERE tipo = '$item' AND localizacao = 'ASCOM' AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $ascom = ceil($row_pg['ascom']);

    $buscar_produtos = "SELECT COUNT(idbem) AS atecc FROM item WHERE tipo = '$item' AND localizacao = 'ATECC' AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $atecc = ceil($row_pg['atecc']);

    $buscar_produtos = "SELECT COUNT(idbem) AS atic FROM item WHERE tipo = '$item' AND localizacao = 'ATIC' AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $atic = ceil($row_pg['atic']);

    $buscar_produtos = "SELECT COUNT(idbem) AS gab FROM item WHERE tipo = '$item' AND (localizacao = 'GABINETE' OR localizacao = 'AUDITÓRIO/GAB' OR localizacao='GAB' OR localizacao = 'GAB/SEL' OR localizacao='GAB SEL') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $gab = ceil($row_pg['gab']);

    $buscar_produtos = "SELECT COUNT(idbem) AS stel FROM item WHERE tipo = '$item' AND (localizacao = 'STEL' OR localizacao = ' STEL' OR localizacao = 'CASE STEL' OR localizacao='CASE/STEL') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $stel = ceil($row_pg['stel']);

    $buscar_produtos = "SELECT COUNT(idbem) AS ataj FROM item WHERE tipo = '$item' AND localizacao = 'ATAJ' AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $ataj = ceil($row_pg['ataj']);

    $gabinete = $ascom + $atecc + $atic + $gab + $stel + $ataj;

    $buscar_produtos = "SELECT COUNT(idbem) AS caf_g FROM item WHERE tipo = '$item' AND (localizacao = 'CAF' OR localizacao='CAF-G') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $caf_g = ceil($row_pg['caf_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dgp FROM item WHERE tipo = '$item' AND (localizacao = 'DGP' OR localizacao = 'CAF/DGP' OR localizacao =' CAF/DGP') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dgp = ceil($row_pg['dgp']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dlc FROM item WHERE tipo = '$item' AND (localizacao = 'DLC' OR localizacao = 'CAF/DLC'  OR localizacao = 'CAF DLC') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dlc = ceil($row_pg['dlc']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dof FROM item WHERE tipo = '$item' AND (localizacao = 'DOF' OR localizacao = 'CAF/DOF' OR localizacao = 'CAF DOF') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dof = ceil($row_pg['dof']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dsup FROM item WHERE tipo = '$item' AND (localizacao = 'DSUP' OR localizacao = 'CAF/DSUP' OR localizacao = 'CAF DSUP') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dsup = ceil($row_pg['dsup']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dsupDeposito FROM item WHERE tipo = '$item' AND localizacao = 'DSUP-DEPOSITO' AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dsupDepo = ceil($row_pg['dsupDeposito']);

    $buscar_produtos = "SELECT COUNT(idbem) AS drv FROM item WHERE tipo = '$item' AND (localizacao = 'DRV' OR localizacao = 'CAF/DRV' OR localizacao = 'CAF DRV') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $drv = ceil($row_pg['drv']);


    $caf = $caf_g + $dgp + $dlc + $dof + $dsup + $dsupDepo + $drv;

    $buscar_produtos = "SELECT COUNT(idbem) AS cap_g FROM item WHERE tipo = '$item' AND (localizacao = 'CAP' OR localizacao='CAP-G') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $cap_g = ceil($row_pg['cap_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS deprot FROM item WHERE tipo = '$item' AND (localizacao = 'DEPROT' OR localizacao = 'CAP/DEPROT') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $deprot = ceil($row_pg['deprot']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dpci FROM item WHERE tipo = '$item' AND (localizacao = 'DPCI' OR localizacao = 'CAP/DPCI') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dpci = ceil($row_pg['dpci']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dpd FROM item WHERE tipo = '$item' AND (localizacao = 'DPD' OR localizacao = 'CAP/DPD' OR localizacao = 'CAP/GAB/DPD') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dpd = ceil($row_pg['dpd']);

    $buscar_produtos = "SELECT COUNT(idbem) AS nucleo FROM item WHERE tipo = '$item' AND (localizacao = 'NUCLEO' OR localizacao = 'CAP/NUCLEO' OR localizacao = 'CAP NUCLEO') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $nucleo = ceil($row_pg['nucleo']);

    $buscar_produtos = "SELECT COUNT(idbem) AS saboya FROM item WHERE tipo = '$item' AND (localizacao = 'SABOYA' OR localizacao = 'CAP/SABOYA' OR localizacao = 'CAP SABOYA' OR localizacao = 'CAP/SABOYA FINAL') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $saboya = ceil($row_pg['saboya']);

    $cap = $cap_g + $deprot + $dpci + $dpd + $nucleo + $saboya;

    $buscar_produtos = "SELECT COUNT(idbem) AS case_g FROM item WHERE tipo = '$item' AND (localizacao = 'CASE' OR localizacao='CASE-G') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $case_g = ceil($row_pg['case_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dcad FROM item WHERE tipo = '$item' AND (localizacao = 'DCAD' OR localizacao='CASE/DCAD') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dcad = ceil($row_pg['dcad']);

    $buscar_produtos = "SELECT COUNT(idbem) AS ddu FROM item WHERE tipo = '$item' AND (localizacao = 'DDU' OR localizacao='CASE/DDU') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $ddu = ceil($row_pg['ddu']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dle FROM item WHERE tipo = '$item' AND (localizacao = 'DLE' OR localizacao='CASE/DLE') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dle = ceil($row_pg['dle']);

    $case = $case_g + $dcad + $ddu + $dle;

    $buscar_produtos = "SELECT COUNT(idbem) AS cepeuc FROM item WHERE tipo = '$item' AND (localizacao = 'CEPEUC' OR localizacao='CEPEUC-G') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $cepeuc_g = ceil($row_pg['cepeuc']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dcit FROM item WHERE tipo = '$item' AND (localizacao = 'DCIT' OR localizacao='CEPEUC/DCIT' OR localizacao='CEPEUC DCIT') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dcit = ceil($row_pg['dcit']);

    $buscar_produtos = "SELECT COUNT(idbem) AS ddoc FROM item WHERE tipo = '$item' AND (localizacao = 'DDOC' OR localizacao='CEPEUC/DDOC' OR localizacao='CEPEUC DDOC') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $ddoc = ceil($row_pg['ddoc']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dvf FROM item WHERE tipo = '$item' AND (localizacao = 'DVF' OR localizacao='CEPEUC/DVF' OR localizacao='CEPEUC DVF') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dvf = ceil($row_pg['dvf']);

    $cepeuc = $cepeuc_g + $dcit + $ddoc + $dvf;

    $buscar_produtos = "SELECT COUNT(idbem) AS comin_g FROM item WHERE tipo = '$item' AND (localizacao = 'COMIN' OR localizacao='COMIN-G') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $comin_g = ceil($row_pg['comin_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dcigp FROM item WHERE tipo = '$item' AND (localizacao = 'DCIGP' OR localizacao='COMIN/DCIGP') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dcigp = ceil($row_pg['dcigp']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dcimp FROM item WHERE tipo = '$item' AND (localizacao = 'DCIMP' OR localizacao='COMIN/DCIMP') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dcimp = ceil($row_pg['dcimp']);

    $comin = $comin_g + $dcigp + $dcimp;

    $buscar_produtos = "SELECT COUNT(idbem) AS contru_g FROM item WHERE tipo = '$item' AND (localizacao = 'CONTRU' OR localizacao='CONTRU-G') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $contru_g = ceil($row_pg['contru_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dacess FROM item WHERE tipo = '$item' AND (localizacao = 'DACESS' OR localizacao = 'CONTRUDACESS' OR localizacao = 'CONTRU/DACESS') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dacess = ceil($row_pg['dacess']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dins FROM item WHERE tipo = '$item' AND (localizacao = 'DINS' OR localizacao = 'CONTRU/DINS') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dins = ceil($row_pg['dins']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dlr FROM item WHERE tipo = '$item' AND (localizacao = 'DLR' OR localizacao = 'CONTRU/DLR') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dlr = ceil($row_pg['dlr']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dsus FROM item WHERE tipo = '$item' AND (localizacao = 'DSUS' OR localizacao = 'CONTRU/DSUS') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dsus = ceil($row_pg['dsus']);

    $contru = $contru_g + $dacess + $dins + $dlr + $dsus;

    $buscar_produtos = "SELECT COUNT(idbem) AS deuso_g FROM item WHERE tipo = '$item' AND (localizacao = 'DEUSO' OR localizacao='DEUSO-G' OR localizacao = 'DEUSO GABINETE' OR localizacao = 'DEUSO/GABINETE') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $deuso_g = ceil($row_pg['deuso_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dmus FROM item WHERE tipo = '$item' AND (localizacao = 'DMUS' OR localizacao = 'DEUSO/DMUS') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dmus = ceil($row_pg['dmus']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dnus FROM item WHERE tipo = '$item' AND (localizacao = 'DNUS' OR localizacao = 'DEUSO/DNUS' OR localizacao = 'DEUSO DNUS') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dnus = ceil($row_pg['dnus']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dsiz FROM item WHERE tipo = '$item' AND (localizacao = 'DSIZ' OR localizacao = 'DEUSO/DSIZ') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dsiz = ceil($row_pg['dsiz']);

    $deuso = $deuso_g + $dmus + $dnus + $dsiz;

    $buscar_produtos = "SELECT COUNT(idbem) AS geoinfo FROM item WHERE tipo = '$item' AND (localizacao = 'GEOINFO' OR localizacao='GEOINFO-G') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $geoinfo_g = ceil($row_pg['geoinfo']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dad FROM item WHERE tipo = '$item' AND (localizacao = 'DAD' OR localizacao = 'GEOINFO/DAD' OR localizacao = 'GEOINFO DAD') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dad = ceil($row_pg['dad']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dag FROM item WHERE tipo = '$item' AND (localizacao = 'DAG' OR localizacao = 'GEOINFO/DAG' OR localizacao = 'GEOINFO DAG') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dag = ceil($row_pg['dag']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dsig FROM item WHERE tipo = '$item' AND (localizacao = 'DSIG' OR localizacao = 'GEOINFO/DSIG' OR localizacao = 'GEOINFO DSIG') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dsig = ceil($row_pg['dsig']);

    $buscar_produtos = "SELECT COUNT(idbem) AS obs FROM item WHERE tipo = '$item' AND (localizacao = 'OBS' OR localizacao = 'GEOINFO/OBS' OR localizacao = 'GEOINFO OBS') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $obs = ceil($row_pg['obs']);

    $geoinfo = $geoinfo_g + $dad + $dag + $dsig + $obs;

    $buscar_produtos = "SELECT COUNT(idbem) AS gtec FROM item WHERE tipo = '$item' AND (localizacao = 'GTEC' OR localizacao='GTEC-G') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $gtec = ceil($row_pg['gtec']);

    $buscar_produtos = "SELECT COUNT(idbem) AS parhis_g FROM item WHERE tipo = '$item' AND (localizacao = 'PARHIS' OR localizacao='PARHIS-G') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $parhis_g = ceil($row_pg['parhis_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dhmp FROM item WHERE tipo = '$item' AND (localizacao = 'DHMP' OR localizacao='PARHIS/DHMP') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dhmp = ceil($row_pg['dhmp']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dps FROM item WHERE tipo = '$item' AND (localizacao = 'DPS' OR localizacao='PARHIS/DPS') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dps = ceil($row_pg['dps']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dhpp FROM item WHERE tipo = '$item' AND (localizacao = 'DHPP' OR localizacao='PARHIS/DHPP' OR localizacao='PARHIS DHPP') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dhpp = ceil($row_pg['dhpp']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dhgp FROM item WHERE tipo = '$item' AND (localizacao = 'DHGP' OR localizacao='PARHIS/DHGP' OR localizacao='PARHIS DHGP') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dhgp = ceil($row_pg['dhgp']);

    $parhis = $parhis_g + $dhgp + $dhmp + $dhpp + $dps;

    $buscar_produtos = "SELECT COUNT(idbem) AS planurb_g FROM item WHERE tipo = '$item' AND (localizacao = 'PLANURB' OR localizacao='PLANURB-G') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $planurb_g = ceil($row_pg['planurb_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dart FROM item WHERE tipo = '$item' AND (localizacao = 'DART' OR localizacao='PLANURB/DART' OR localizacao='PLANURB DART') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dart = ceil($row_pg['dart']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dma FROM item WHERE tipo = '$item' AND (localizacao = 'DMA' OR localizacao='PLANURB/DMA' OR localizacao='PLANURB DMA') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dma = ceil($row_pg['dma']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dot FROM item WHERE tipo = '$item' AND (localizacao = 'DOT' OR localizacao='PLANURB/DOT' OR localizacao='PLANURB DOT') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dot = ceil($row_pg['dot']);

    $planurb = $planurb_g + $dart + $dma + $dot;

    $buscar_produtos = "SELECT COUNT(idbem) AS resid_g FROM item WHERE tipo = '$item' AND (localizacao = 'RESID' OR localizacao='RESID-G') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $resid_g = ceil($row_pg['resid_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS drgp FROM item WHERE tipo = '$item' AND (localizacao = 'DRGP' OR localizacao='RESID/DRGP') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $drgp = ceil($row_pg['drgp']);

    $buscar_produtos = "SELECT COUNT(idbem) AS drh FROM item WHERE tipo = '$item' AND (localizacao = 'DRH' OR localizacao='RESID/DRH') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $drh = ceil($row_pg['drh']);

    $buscar_produtos = "SELECT COUNT(idbem) AS drve FROM item WHERE tipo = '$item' AND (localizacao = 'DRVE' OR localizacao='RESID/DRVE') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $drve = ceil($row_pg['drve']);

    $resid = $resid_g + $drgp + $drh + $drve;

    $buscar_produtos = "SELECT COUNT(idbem) AS servin_g FROM item WHERE tipo = '$item' AND (localizacao = 'SERVIN' OR localizacao='SERVIN-G') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $servin_g = ceil($row_pg['servin_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dsigp FROM item WHERE tipo = '$item' AND (localizacao = 'DSIGP' OR localizacao='SERVIN/DSIGP') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dsigp = ceil($row_pg['dsigp']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dsimp FROM item WHERE tipo = '$item' AND (localizacao = 'DSIMP' OR localizacao='SERVIN/DSIMP') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dsimp = ceil($row_pg['dsimp']);

    $servin = $servin_g + $dsigp + $dsimp;

    $buscar_produtos = "SELECT COUNT(idbem) AS semLocalizacao FROM item WHERE tipo = '$item' AND (localizacao = '' OR localizacao='?') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $semLocalizacao = ceil($row_pg['semLocalizacao']);

    $buscar_produtos = "SELECT COUNT(idbem) AS caepp_g FROM item WHERE tipo = '$item' AND (localizacao = 'CAEPP-G' OR localizacao='CAEPP' OR localizacao = 'LICEN') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $caepp_g = ceil($row_pg['caepp_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dccpp FROM item WHERE tipo = '$item' AND (localizacao = 'DCCPP' OR localizacao='CAEPP/DCCPP') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $decpp = ceil($row_pg['dccpp']);

    $buscar_produtos = "SELECT COUNT(idbem) AS derpp FROM item WHERE tipo = '$item' AND (localizacao = 'DERPP' OR localizacao='CAEPP/DERPP') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $derpp = ceil($row_pg['derpp']);

    $buscar_produtos = "SELECT COUNT(idbem) AS despp FROM item WHERE tipo = '$item' AND (localizacao = 'DESPP' OR localizacao='CAEPP/DESPP') AND statusitem != 'Descartado' AND excluido != 1;";
    $query_produto = mysqli_query($conexao, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $despp = ceil($row_pg['despp']);

    $caepp = $caepp_g + $decpp + $derpp + $despp;

    ?>
    <div class="p-4 p-md-4 pt-3 conteudo">
        <div class="carrossel-box mb-2">
            <div class="carrossel">
                <a href="./home.php" class="mb-3 me-1">
                    <img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt="">
                </a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-avancar" alt="icon-avancar">
                <a href="./dashboard.php" class="text-muted ms-1 carrossel-text">Dashboard</a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-avancar ms-1" alt="icon-avancar">
                <a href="#" class="text-primary ms-1 carrossel-text">Distribuição</a>
            </div>
        </div>
        <div class="d-flex" style="margin-left: 550px;">
            <div class="card mb-3 me-3 rounded-0 shadow p-3 mb-5 bg-white rounded border-0">
                <div class="card-body d-flex flex-column" style="width: 450px;">
                    <label for="card" class="form-label mt-1 text-primary">Item selecionado:</label>
                    <select class="form-select" name="tipo" id="tipo" onchange="trocouItem()" required>
                        <option value="<?php echo $_GET['inputText'] ?>" hidden="hidden"><?php echo $_GET['inputText'] ?></option>
                        <?php
                        include 'query-tipos.php';
                        ?>
                    </select>
                </div>
                <p class="card-text mb-3 mt-2 m-auto" style="font-size: 20px;"><strong class="mr-2">Total:</strong>
                    <?php echo "<span>$totalItem</span>" ?></p>
            </div>
            <div class="d-flex aling justify-content-end align-items-end mr-3 mb-4" style="margin-left: 300px;">
                <p class="mr-3 text-primary">Sem localização: </p> <?php echo '<span class="mb-3">' . $semLocalizacao . '</span>' ?>
            </div>
        </div>
        <div class="text-center px-2">
            <div class="row mb-2 w-70 d-flex flex-row align-items-stretch">
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>GABINETE (total: <?php echo $gabinete; ?>)</strong></li>
                        <li class="list-group-item d-flex justify-content-start">ASCOM: <?php echo "<span class='ml-4'>" . $ascom . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">ATECC: <?php echo "<span class='margin-atecc'>" . $atecc . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">ATIC: <?php echo "<span class='margin-atic'>" . $atic . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">GAB: <?php echo "<span class='margin-gab'>" . $gab . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">STEL: <?php echo "<span class='margin-stel'>" . $stel . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">ATAJ: <span class='margin-stel'><?php echo $ataj; ?></span></li>
                        <li class="list-group-item">ㅤ</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group" style="height: 320px;">
                        <li class="list-group-item list-group-item-primary"><strong>CAF (total: <?php echo $caf; ?>)</strong></li>
                        <li class="list-group-item d-flex justify-content-start">CAF: <?php echo "<span class='ml-4'>" . $caf_g . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DGP: <?php echo "<span class='margin-dgp'>" . $dgp . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DLC: <?php echo "<span class='margin-dlc'>" . $dlc . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DOF: <?php echo "<span class='margin-dof'>" . $dof . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DSUP: <?php echo "<span class='margin-dsup'>" . $dsup . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DRV: <?php echo "<span class='margin-drv'>" . $drv . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DSUP/DEPOSITO: <?php echo "<span class='ml-3'>" . $dsupDepo . "</span>" ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group d-flex justify-content-evenly">
                        <li class="list-group-item list-group-item-primary"><strong>CAP (total: <?php echo $cap; ?>)</strong></li>
                        <li class="list-group-item d-flex justify-content-start">CAP: <?php echo "<span class='margin-capg'>" . $cap_g . "</span>"  ?></li>
                        <li class="list-group-item d-flex justify-content-start">DPCI: <?php echo "<span class='margin-dpci'>" . $dpci . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DPD: <?php echo "<span class='margin-dpd'>" . $dpd . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DEPROT: <?php echo "<span class='margin-deprot'>" . $deprot . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">NÚCLEO: <?php echo "<span class='margin-nucleo'>" . $nucleo . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">ARTHUR SABOYA: <?php echo "<span class='ml-3'>" . $saboya . "</span>" ?></li>
                        <li class="list-group-item">ㅤ</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>GEOINFO (total: <?php echo $geoinfo; ?>)</strong></li>
                        <li class="list-group-item d-flex justify-content-start">GEOINFO: <?php echo "<span class='ml-4'>" . $geoinfo_g . "</span>"; ?></li>
                        <li class="list-group-item d-flex justify-content-start">DAD: <?php echo "<span class='ml-4'>" . $dad . "</span>"; ?></li>
                        <li class="list-group-item d-flex justify-content-start">DAG: <?php echo "<span class='ml-4'>" . $dag . "</span>"; ?></li>
                        <li class="list-group-item d-flex justify-content-start">DSIG: <?php echo "<span class='margin-dsi'>" . $dsig . "</span>"; ?></li>
                        <li class="list-group-item d-flex justify-content-start">OBS: <?php echo "<span class='margin-obs'>" . $obs . "</span>"; ?></li>
                        <li class="list-group-item">ㅤ</li>
                        <li class="list-group-item">ㅤ</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CONTRU (total: <?php echo $contru; ?>)</strong></li>
                        <li class="list-group-item d-flex justify-content-start">CONTRU: <?php echo "<span class='ml-4'>" . $contru_g . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DACESS: <?php echo  "<span class='margin-dacess'>" . $dacess . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DSUS: <?php echo "<span class='margin-dsus'>" . $dsus . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DINS: <?php echo "<span class='margin-dins'>" . $dins . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DLR: <?php echo "<span class='margin-dlr'>" . $dlr . "</span>" ?></li>
                        <li class="list-group-item">ㅤ</li>
                        <li class="list-group-item">ㅤ</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>PARHIS (total: <?php echo $parhis; ?>)</strong></li>
                        <li class="list-group-item d-flex justify-content-start">PARHIS: <?php echo "<span class='ml-4'>" . $parhis_g .  "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DHGP: <?php echo  "<span class='margin-dhgp'>" . $dhgp .  "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DHMP: <?php echo  "<span class='margin-dhmp'>" . $dhmp .  "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DHPP: <?php echo "<span class='margin-dhpp'>" . $dhpp .  "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DPS: <?php echo "<span class='margin-dps'>" . $dps .  "</span>" ?></li>
                        <li class="list-group-item">ㅤ</li>
                        <li class="list-group-item">ㅤ</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>RESID (total: <?php echo $resid; ?>)</strong></li>
                        <li class="list-group-item d-flex justify-content-start">RESID: <?php echo "<span class='ml-4'>" . $resid_g . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DRGP: <?php echo "<span class='margin-drgp'>" . $drgp . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DRH: <?php echo "<span class='margin-dru'>" . $drh . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DRVE: <?php echo "<span class='margin-drve'>" . $drve . "</span>" ?></li>
                        <li class="list-group-item">ㅤ</li>
                        <li class="list-group-item">ㅤ</li>
                        <li class="list-group-item">ㅤ</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center px-2">
            <div class="row mb-2 w-80">
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CASE (total: <?php echo $case; ?>)</strong></li>
                        <li class="list-group-item d-flex justify-content-start">CASE: <?php echo "<span class='ml-4'>" . $case_g . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DLE: <?php echo "<span class='margin-dle'>" . $dle . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DDU: <?php echo "<span class='margin-ddu'>" . $ddu . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DCAD: <?php echo "<span class='margin-dcad'>" . $dcad . "</span>" ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>COMIN (total: <?php echo $comin; ?>)</strong></li>
                        <li class="list-group-item d-flex justify-content-start">COMIN: <?php echo "<span class='ml-4'>" . $comin_g .  "</span>"  ?></li>
                        <li class="list-group-item d-flex justify-content-start">DCIGP: <?php echo  "<span class='margin-dcigp'>" . $dcigp . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DCIMP: <?php echo "<span class='margin-dcimp'>" . $dcimp . "</span>" ?></li>
                        <li class="list-group-item">ㅤ</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>SERVIN (total: <?php echo $servin; ?>)</strong></li>
                        <li class="list-group-item d-flex justify-content-start">SERVIN: <?php echo "<span class='ml-4'>" . $servin_g . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DSIGP: <?php echo "<span class='margin-dsigp'>" . $dsigp . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DSIMP: <?php echo "<span class='margin-dsimp'>" . $dsimp . "</span>" ?></li>
                        <li class="list-group-item">ㅤ</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CEPEUC (total: <?php echo $cepeuc; ?> )</strong></li>
                        <li class="list-group-item  d-flex justify-content-start">CEPEUC: <?php echo "<span class='ml-4'>" . $cepeuc_g . "</span>" ?></li>
                        <li class="list-group-item  d-flex justify-content-start">DDOC: <?php echo "<span class='ml-3'>" . $ddoc . "</span>" ?></li>
                        <li class="list-group-item  d-flex justify-content-start">DCIT: <?php echo "<span class='ml-4'>" . $dcit . "</span>" ?></li>
                        <li class="list-group-item  d-flex justify-content-start">DVF: <?php echo "<span class='margin-dvf'>" . $dvf . "</span>" ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>DEUSO (total: <?php echo $deuso; ?>)</strong></li>
                        <li class="list-group-item d-flex justify-content-start">DEUSO: <?php echo "<span class='ml-4'>" . $deuso_g . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DMUS: <?php echo "<span class='margin-dmus'>" . $dmus . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DNUS: <?php echo "<span class='margin-dnus'>" . $dnus . "</span>" ?></li>
                        <li class="list-group-item d-flex justify-content-start">DSIZ: <?php echo "<span class='margin-dsiz'>" . $dsiz . "</span>" ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>PLANURB (total: <?php echo $planurb; ?>)</strong></li>
                        <li class="list-group-item d-flex justify-content-start">PLANURB: <?php echo "<span class='ml-4'>" . $planurb_g . "</span>"; ?></li>
                        <li class="list-group-item d-flex justify-content-start">DART: <?php echo "<span class='ml-4'>" . $dart . "</span>"; ?></li>
                        <li class="list-group-item d-flex justify-content-start">DMA: <?php echo "<span class='margin-dma'>" . $dma . "</span>"; ?></li>
                        <li class="list-group-item d-flex justify-content-start">DOT: <?php echo "<span class='ml-4'>" . $dot . "</span>"; ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CAEPP (total: <?php echo $caepp; ?>)</strong></li>
                        <li class="list-group-item d-flex justify-content-start">CAEPP: <?php echo "<span class='ml-4'>" . $caepp_g . "</span>"; ?></li>
                        <li class="list-group-item d-flex justify-content-start">DECPP: <?php echo "<span class='margin-decpp'>" . $decpp . "</span>"; ?></li>
                        <li class="list-group-item d-flex justify-content-start">DERPP: <?php echo "<span class='margin-derpp'>" . $derpp . "</span>"; ?></li>
                        <li class="list-group-item d-flex justify-content-start">DESPP: <?php echo "<span class='margin-despp'>" . $despp . "</span>"; ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group mb-3">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>GTEC (total: <?php echo $gtec; ?>)</strong></li>
                        <li class="list-group-item d-flex justify-content-start">GTEC: <?php echo "<span class='margin-gtec'>" . $gtec . "</span>"; ?></li>
                        <li class="list-group-item">ㅤ</li>
                        <li class="list-group-item">ㅤ</li>
                        <li class="list-group-item">ㅤ</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <div class="hide" id="modal"></div>
</body>
<script>
    function trocouItem() {
        var select = document.getElementById('tipo');
        var url = 'resultadodash.php?inputText=' + encodeURIComponent(select.value);
        window.history.replaceState({}, '', url);
        window.location.reload(true);
    }
</script>