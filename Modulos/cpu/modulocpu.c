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

static int cpu_proc_show(struct seq_file *m, void *v)
{
    unsigned long pages[NR_LRU_LISTS];
    int lru, j;
    u64 user, nice, system, idle, iowait, irq, softirq, steal, activo, total, guest, guest_nice;

    user=nice=system=idle=iowait=irq=softirq=steal=activo=total=guest=guest_nice = 0;

    for (lru = LRU_BASE; lru < NR_LRU_LISTS; lru++)
    {
        pages[lru] = global_page_state(NR_LRU_BASE + lru);
    }

    for_each_possible_cpu(j)
    {
        user = kcpustat_cpu(j).cpustat[CPUTIME_USER];
        iowait = kcpustat_cpu(j).cpustat[CPUTIME_IOWAIT];
        system = kcpustat_cpu(j).cpustat[CPUTIME_SYSTEM];
        nice = kcpustat_cpu(j).cpustat[CPUTIME_NICE];
        idle = kcpustat_cpu(j).cpustat[CPUTIME_IDLE];
        irq = kcpustat_cpu(j).cpustat[CPUTIME_IRQ];
        softirq = kcpustat_cpu(j).cpustat[CPUTIME_SOFTIRQ];
        steal = kcpustat_cpu(j).cpustat[CPUTIME_STEAL];
        guest = kcpustat_cpu(j).cpustat[CPUTIME_GUEST];
        guest_nice = kcpustat_cpu(j).cpustat[CPUTIME_GUEST_NICE];
    }

    seq_printf(m,"<rss>\n"                  
                 "\t<cpu>\n"
                 "\t\t<user>%llu</user>\n"
                 "\t\t<iowait>%llu</iowait>\n"
                 "\t\t<system>%llu</system>\n"
                 "\t\t<nice>%llu</nice>\n"
                 "\t\t<idle>%llu</idle>\n"
                 "\t\t<irq>%llu</irq>\n"
                 "\t\t<softirq>%llu</softirq>\n"
                 "\t\t<steal>%llu</steal>\n"
                 "\t\t<guest>%llu</guest>\n"
                 "\t\t<guest_nice>%llu</guest_nice>\n"
                 "\t</cpu>\n"
                 "</rss>\n"             
                ,user = cputime64_to_clock_t(user)
                ,iowait = cputime64_to_clock_t(iowait)
                ,system = cputime64_to_clock_t(system)
                ,nice = cputime64_to_clock_t(nice)
                ,idle = cputime64_to_clock_t(idle)
                ,irq = cputime64_to_clock_t(irq)
                ,softirq = cputime64_to_clock_t(softirq)
                ,steal = cputime64_to_clock_t(steal)
                ,guest = cputime64_to_clock_t(guest)
                ,guest_nice = cputime64_to_clock_t(guest_nice)
                );
    return 0;
}

static int cpu_proc_open(struct inode *inode, struct file *file)
{
    return single_open(file, cpu_proc_show, NULL);
}

static const struct file_operations cpu_proc_fops = {
    .open       = cpu_proc_open,
    .read       = seq_read,
    .llseek     = seq_lseek,
    .release    = single_release,
};

static void __exit proc_cpu_cleanup(void)
{
        printk(KERN_INFO "Saliendo de cpu!\n");
};

static int __init proc_cpu_init(void)
{
    proc_create("infocpu", 0, NULL, &cpu_proc_fops);
    printk(KERN_ALERT "MODULO DE CPU INICIADO");
    return 0;
}

fs_initcall(proc_cpu_init);
module_exit(proc_cpu_cleanup);