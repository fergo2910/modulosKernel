#include <linux/module.h>
#include <linux/fs.h>
#include <linux/init.h>
#include <linux/kernel.h>
#include <linux/mm.h>
#include <linux/hugetlb.h>
#include <linux/mman.h>
#include <linux/mmzone.h>
#include <linux/proc_fs.h>
#include <linux/quicklist.h>
#include <linux/seq_file.h>
#include <linux/swap.h>
#include <linux/vmstat.h>
#include <linux/atomic.h>
#include <linux/vmalloc.h>
#include <asm/page.h>
#include <asm/pgtable.h>
#include <linux/sched.h>

#include <linux/cpumask.h>
#include <linux/interrupt.h>
#include <linux/kernel_stat.h>
#include <linux/proc_fs.h>
#include <linux/sched.h>
#include <linux/slab.h>
#include <linux/time.h>
#include <linux/irqnr.h>
#include <linux/cputime.h>
#include <linux/tick.h>

static int proc_show(struct seq_file *m, void *v)
{
	struct task_struct *task;

	seq_printf(m,"<rss>\n");

	for_each_process(task)
    {
    	seq_printf(m,"\t<proceso>\n"
    				 "\t\t<comm>%s</comm>\n"
                     "\t\t<state>%lu</state>\n"
    				 "\t\t<pid>%d</pid>\n"
    				 "\t\t<parentpid>%d</parentpid>\n"
    				 "\t</proceso>\n"
    				 ,task->comm 
                     ,task->state
    				 ,task->pid
    				 ,task->parent->pid);
    }

    seq_printf(m,"</rss>\n");

    return 0;
}

static int proc_open(struct inode *inode, struct file *file)
{
	return single_open(file, proc_show, NULL);
}

static const struct file_operations proc_fops = {
	.open		= proc_open,
	.read		= seq_read,
	.llseek		= seq_lseek,
	.release	= single_release,
};

static void __exit proc_cleanup(void)
{
	printk(KERN_INFO "Saliendo de proceso!\n");
};

static int __init proc_init(void)
{
	proc_create("infoproc", 0, NULL, &proc_fops);
    printk(KERN_ALERT "MODULO DE PROCESOS ARBOL INICIADO");
	return 0;
}

fs_initcall(proc_init);
module_exit(proc_cleanup);