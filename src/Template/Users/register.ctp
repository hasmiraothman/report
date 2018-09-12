<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Register User') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('email');
            echo $this->Form->control('password');
            echo $this->Form->control('regno');
            echo $this->Form->control('role',[
            'options' => ['admin' => 'Admin', 'employer' => 'Employer', 'employee' => 'Employee']]);
            echo $this->Form->control('department', [
            'options' => ['admin' => 'Admin','employer' => 'Employer', 'employee' => 'Employee', 'accountdept' => 'Account  Department', 'admindept' => 'Admin Department', 'labdept' => 'Lab Department']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
