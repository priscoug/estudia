<?php echo $this->Html->css('form', null, array('inline' => false));?>

<div id="breadcrumbs">
	<?php echo $this->Html->link("Mes cours", array("controller" => "cours", "action" => "manager"), array("title" => "Voir tous mes cours"));?>
            >> <?php echo $path['Cour']['name'];?> >> Ajouter/Supprimer/Modifier les parties


</div>

<span class="etat action"><?php echo $this->Html->link('En attente de publication', array('controller' => 'parties', 'action'=> 'manager', $coursId, "nonpublic","enattente")); ?></span>
<span class="etat action"><?php echo $this->Html->link('En attente de dépublication', array('controller' => 'parties', 'action'=> 'manager', $coursId, "public","enattente")); ?></span>
<span class="etat action"><?php echo $this->Html->link('Publié', array('controller' => 'parties', 'action'=> 'manager', $coursId, "public")); ?></span>
<span class="etat action"><?php echo $this->Html->link('Non-Publié', array('controller' => 'parties', 'action'=> 'manager', $coursId, "nonpublic")); ?></span>

<?php if($parties != array()): ?>

<table class="manager">
   <thead>
     <tr>
        <th class="first" style="text-align: center">Cours</th>
        <th style="text-align: center; width:40px">Déplacer</th>
        <th class="last" style="text-align: center; width:210px">Actions</th>
     </tr>
     </thead>
     <tbody>
     <?php foreach($parties as $cours_info): $c = current($cours_info); ?>
        <tr>
             <td><?php echo $c['sort_order'].') '; echo $this->Html->link($c['name'], array('action' => 'admin_visualiser', $c['id'], $c['slug']));?><br />

             <?php if($c['validation']){
                    if($c['public']){
                        echo '<span class="etat en_attente">En attente de dépublication</span>';
                    }
                    else{
                        echo '<span class="etat en_attente">En attente de publication</span>';
                    }
                }else{
                    if($c['public']){
                        echo '<span class="etat publie">Publié</span>';
                    }
                    else{
                        echo '<span class="etat non_publie">Non-publié</span>';
                    }                    
               
                }
                ?></td>
              <td style="text-align: center">
                <?php echo $this->Html->image('fleche_haut.png', array(
                    "url"=> array("action"=>"monter", $c['id'])
                ));?> / 
                <?php echo $this->Html->image('fleche_bas.png', array(
                    "url"=> array("action"=>"descendre", $c['id'])
                )); ?>
             </td>
             <td style="text-align: left;">  
             <?php echo $this->Html->link($this->Html->image('editer.png'), array("action"=>"edit", $c['id'], $c['slug']),array("escape" => false)); ?>
             <?php echo $this->Html->link('<span class="etat action">'.$this->Html->image('supprimer.png').' Supprimer</span>', 
                     array("action"=>"delete", $c['id']),
                     array("title" =>"Supprimer cette", 'escape' => false),
                     "Etes-vous certain de vouloir définitivement supprimer ce cours ?"
             );?>

             <?php 
                    echo $this->Html->link('<span class="etat action">Ajouter/Dépublier les sous-parties</span>', 
                        array("controller" => "sousparties", "action" => "manager", $c['id'], $c['slug']),
                        array("title" =>"Ajouter ou dépublier une sous-partie", "escape"=>false));
              
                    if($c['public']){
                        echo $this->Html->link('<span class="etat action">Dépublier</span>', 
                             array("action"=>"publier", $c['id'], $c['token']),
                             array("title" =>"Demander la dépublication", 'escape' => false),
                             "Une fois dépublié, ce cours n'apparaitra plus en ligne. Vous pourrez toutefois demander sa publication à nouveau. Souhaitez-vous toujours demander sa dépublication dès maintenant ?"
                        );
                    }else{
                        echo $this->Html->link('<span class="etat action">Publier</span>', 
                             array("action"=>"publier", $c['id'], $c['token']),
                             array("title" =>"Demander la publication", 'escape' => false),
                             "Une fois publié, pour modifier ce cours, vous devrez d'abord demander sa dépublication. Souhaitez-vous toujours demander la publication dès maintenant ?"
                        );                 
                    }
             ?></td>
         </tr>
     <?php endforeach; ?>
     </tbody>
 </table>

<?php else: ?>
    <p>Vous n'avez ajouté aucunes parties à ce cours pour le moment. Cliquez ci-dessus pour créer des parties.</p>
<?php endif; ?>