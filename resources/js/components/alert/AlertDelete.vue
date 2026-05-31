<script lang="ts" setup>
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle, AlertDialogTrigger } from '../ui/alert-dialog';
import Button from '../ui/button/Button.vue';

const props = defineProps<{
    onConfirm: () => void,
    title?: string,
    description: string,
    confirmText?: string
}>();

const handleConfirm = () => {
    props.onConfirm()
}

</script>
<template>
    <AlertDialog>
        <AlertDialogTrigger as-child>
            <Button class="hover:cursor-pointer text-white" variant="destructive">Delete</Button>
        </AlertDialogTrigger>
        <AlertDialogContent>
        <AlertDialogHeader>
            <AlertDialogTitle>{{title || 'Yakin untuk menghapus?' }}</AlertDialogTitle>
            <AlertDialogDescription>
                {{ description || "Apakah anda yakin akan menghapus data ini?" }}
            </AlertDialogDescription>
        </AlertDialogHeader>
        <AlertDialogFooter>
            <AlertDialogCancel>Batal</AlertDialogCancel>
            <AlertDialogAction @click="handleConfirm" class="bg-red-700 hover:bg-red-700/80">
                {{ confirmText || "Iya." }}
            </AlertDialogAction>
        </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
