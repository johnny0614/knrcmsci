<!doctype html>
<html>
<head>
<title><?php echo $this->config->item('site_title'); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/style.css'); ?>" />
</head>
<body>
<div id="wrapper">
<h1><?php echo $this->config->item('site_title'); ?></h1>

<?php $this->load->view('navmenu_main'); ?>

<div id="content-wrapper">

<?php if ($this->session->flashdata('status')): ?>
<p><?php echo $this->session->flashdata('status');?></p>
<?php endif; ?>