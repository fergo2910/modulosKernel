#include <linux/fs.h>
#include <linux/hugetlb.h>
#include <linux/init.h>
//#include <linux/kernel.h>
#include <linux/module.h>
#include <linux/mm.h>
#include <linux/mman.h>
#include <linux/mmzone.h>
#include <linux/proc_fs.h>
#include <linux/quicklist.h>
#include <linux/seq_file.h>
#include <linux/swap.h>
#include <linux/vmstat.h>
#include <asm/atomic.h>
#include <asm/page.h>
#include <asm/pgtable.h>

void __attribute__((weak)) arch_report_meminfo(struct seq_file *m)
{
}

static int meminfo_proc_show(struct seq_file *m, void *v)
{
	struct sysinfo i;
	unsigned long pages[NR_LRU_LISTS];
	int lru;

/*
 * display in kilobytes.
 */
#define K(x) ((x) << (PAGE_SHIFT - 10))
	si_meminfo(&i);


	for (lru = LRU_BASE; lru < NR_LRU_LISTS; lru++)
		pages[lru] = global_page_state(NR_LRU_BASE + lru);

	/*
	 * Tagged format, for easy grepping and expansion.
	 */
	seq_printf(m,"<rss>\n"
					 "\t<memoria>\n"
					 "\t\t<totalram>%8lu</totalram>\n"
					 "\t\t<freeram>%8lu</freeram>\n"
					 "\t\t<totalswap>%8lu</totalswap>\n"
					 "\t\t<freeswap>%8lu</freeswap>\n"
					 "\t</memoria>\n"
					 "</rss>\n"
					,K(i.totalram)
					,K(i.freeram)
					,K(i.totalswap)
					,K(i.freeswap)
					);

	arch_report_meminfo(m);

	return 0;
#undef K
}

static int meminfo_proc_open(struct inode *inode, struct file *file)
{
	return single_open(file, meminfo_proc_show, NULL);
}

static const struct file_operations meminfo_proc_fops = {
	.open		= meminfo_proc_open,
	.read		= seq_read,
	.llseek		= seq_lseek,
	.release	= single_release,
};

static void __exit proc_cleanup(void)
{
	printk(KERN_INFO "Saliendo de memoria!\n");
};

static int __init proc_meminfo_init(void)
{
	proc_create("infomem", 0, NULL, &meminfo_proc_fops);
	printk(KERN_ALERT "MODULO DE MEMORIA INICIADO");
	return 0;
}

module_init(proc_meminfo_init);
module_exit(proc_cleanup);
